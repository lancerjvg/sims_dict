<?php

namespace App\Http\Controllers;


use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Enrollment::with(['student', 'subject']);

        if ($request->filled('search')) {
            $term = trim($request->search);
            $studentSearch = function ($sq) use ($term) {
                $sq->where('student_number', 'like', "%{$term}%")
                   ->orWhere('first_name', 'like', "%{$term}%")
                   ->orWhere('middle_name', 'like', "%{$term}%")
                   ->orWhere('last_name', 'like', "%{$term}%");
            };
            $query->where(function ($q) use ($term, $studentSearch) {
                $q->whereHas('student', $studentSearch);
                $subjectColumns = Schema::getColumnListing('subjects');
                $searchableSubjectColumns = array_values(array_intersect(
                    ['subject_name', 'name', 'subject_code', 'code'], $subjectColumns
                ));
                if ($searchableSubjectColumns) {
                    $q->orWhereHas('subject', function ($sq) use ($term, $searchableSubjectColumns) {
                        foreach ($searchableSubjectColumns as $column) {
                            $sq->orWhere($column, 'like', "%{$term}%");
                        }
                    });
                }
            });
        }

        if ($request->filled('school_year')) $query->where('school_year', $request->school_year);
        if ($request->filled('semester')) $query->where('semester', $request->semester);
        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('course')) $query->whereHas('student', fn($q) => $q->where('course', $request->course));

        $total = Enrollment::count();
        $active = Enrollment::where('status', 'Active')->count();
        $inactive = Enrollment::where('status', 'Inactive')->count();
        $filtered = $query->latest()->paginate(10)->withQueryString();
        $courses = Student::whereNotNull('course')->where('course', '<>', '')
            ->distinct()->orderBy('course')->pluck('course');
        $schoolYears = Enrollment::whereNotNull('school_year')->distinct()->orderByDesc('school_year')->pluck('school_year');

        return view('enrollments.index', compact('filtered', 'total', 'active', 'inactive', 'courses', 'schoolYears'));
    }


    public function create()
    {
        $students = Student::orderBy('last_name')->orderBy('first_name')->get();
        $subjectColumns = Schema::getColumnListing('subjects');
        $sortSubjectColumn = in_array('subject_code', $subjectColumns) ? 'subject_code' : (in_array('subject_name', $subjectColumns) ? 'subject_name' : 'id');
        $subjects = Subject::orderBy($sortSubjectColumn)->get();
        return view('enrollments.create', compact('students', 'subjects'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'subject_ids' => ['required', 'array', 'min:1'],
            'subject_ids.*' => ['required', 'integer', 'distinct', 'exists:subjects,id'],
            'school_year' => ['required', 'string', 'max:20'],
            'semester' => ['required', 'string', 'max:30'],
            'enrollment_date' => ['required', 'date'],
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ]);

        $studentId = $validated['student_id'];
        $subjectIds = array_values(array_unique($validated['subject_ids']));
        $schoolYear = $validated['school_year'];
        $semester = $validated['semester'];

        $alreadyEnrolled = Enrollment::where('student_id', $studentId)
            ->where('school_year', $schoolYear)
            ->where('semester', $semester)
            ->whereIn('subject_id', $subjectIds)
            ->pluck('subject_id')
            ->map(fn ($id) => (int) $id)
            ->all();

        $toInsert = array_values(array_diff($subjectIds, $alreadyEnrolled));
        if (empty($toInsert)) {
            return back()->withInput()->withErrors([
                'subject_ids' => 'All selected subjects are already enrolled for this student in the selected school year and semester.'
            ]);
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($validated, $studentId, $toInsert) {
            foreach ($toInsert as $subjectId) {
                Enrollment::create([
                    'student_id' => $studentId,
                    'subject_id' => $subjectId,
                    'school_year' => $validated['school_year'],
                    'semester' => $validated['semester'],
                    'enrollment_date' => $validated['enrollment_date'],
                    'status' => $validated['status'],
                ]);
            }
        });

        $insertedCount = count($toInsert);
        $skippedCount = count($alreadyEnrolled);
        $message = "Successfully enrolled in {$insertedCount} subject(s).";
        if ($skippedCount > 0) {
            $message .= " {$skippedCount} duplicate subject(s) skipped.";
        }

        return redirect()->route('enrollments.index')->with('success', $message);
    }


    public function edit(Enrollment $enrollment)
    {
        $enrollment->load(['student', 'subject']);
        $students = Student::orderBy('last_name')->orderBy('first_name')->get();
        $subjectColumns = Schema::getColumnListing('subjects');
        $sortSubjectColumn = in_array('subject_code', $subjectColumns) ? 'subject_code' : (in_array('subject_name', $subjectColumns) ? 'subject_name' : 'id');
        $subjects = Subject::orderBy($sortSubjectColumn)->get();
        return view('enrollments.edit', compact('enrollment', 'students', 'subjects'));
    }


    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'school_year' => ['required', 'string', 'max:20'],
            'semester' => ['required', 'string', 'max:30'],
            'enrollment_date' => ['required', 'date'],
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ]);

        $duplicate = Enrollment::where('student_id', $validated['student_id'])
            ->where('subject_id', $validated['subject_id'])
            ->where('school_year', $validated['school_year'])
            ->where('semester', $validated['semester'])
            ->where('id', '<>', $enrollment->id)->exists();

        if ($duplicate) {
            return back()->withInput()->withErrors(['subject_id' => 'This student is already enrolled in this subject for the selected school year and semester.']);
        }

        $enrollment->update($validated);
        return redirect()->route('enrollments.index')->with('success', 'Enrollment successfully updated.');
    }


    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', 'Enrollment successfully deleted.');
    }
}
