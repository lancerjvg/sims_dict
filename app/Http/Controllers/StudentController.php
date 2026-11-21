<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /** Display student directory. */
    public function index(Request $request)
    {
        $query = Student::query();

        // SEARCH
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('student_number', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('middle_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('course', 'like', "%{$search}%");
            });
        }

        // COURSE FILTER
        if ($request->filled('course')) {
            $query->where('course', $request->course);
        }

        // YEAR LEVEL FILTER
        if ($request->filled('year_level')) {
            $query->where('year_level', $request->year_level);
        }

        // SORTING
        $allowedSorts = [
            'student_number', 'first_name', 'last_name', 'course',
            'year_level', 'created_at',
        ];

        $sort = $request->input('sort', 'last_name');
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'last_name';
        }

        $direction = strtolower($request->input('direction', 'asc'));
        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        $query->orderBy($sort, $direction);


        // SECONDARY SORTING
        if ($sort !== 'first_name') {
            $query->orderBy('first_name', 'asc');
        }
        if ($sort !== 'student_number') {
            $query->orderBy('student_number', 'asc');
        }

        // PAGINATION
        $students = $query->paginate(10)->withQueryString();


        // FILTER OPTIONS
        $courses = Student::query()
            ->whereNotNull('course')
            ->where('course', '<>', '')
            ->distinct()
            ->orderBy('course')
            ->pluck('course');

        $yearLevels = [1, 2, 3, 4, 5, 6];

        return view('students.index', compact(
            'students', 'courses', 'yearLevels', 'sort', 'direction'
        ));
    }


    /** Show create form. */
    public function create()
    {
        $courses = Course::where('is_active', true)
            ->orderBy('course_name', 'asc')
            ->get();


        return view('students.create', compact('courses'));
    }


    /** Store a new student. */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'     => ['required', 'string', 'max:100'],
            'middle_name'    => ['nullable', 'string', 'max:100'],
            'last_name'      => ['required', 'string', 'max:100'],
            'gender'         => ['nullable', Rule::in(['Male', 'Female'])],
            'birth_date'     => ['nullable', 'date', 'before_or_equal:today'],
            'email'          => ['nullable', 'email', 'max:150'],
            'contact_number'  => ['nullable', 'string', 'max:30'],
            'address'        => ['nullable', 'string', 'max:1000'],
            'course'         => ['required', 'string', 'max:150'],
            'year_level'     => ['required', 'integer', 'min:1', 'max:6'],
            'photo'          => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // Store photo on Laravel's public disk; save only the relative path.
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('students', 'public');
        }


        try {
            $student = DB::transaction(function () use ($validated, $photoPath) {
                $yearPrefix = now()->format('Y') . '-';

                $latestStudentNumber = Student::where('student_number', 'like', $yearPrefix . '%')
                    ->orderBy('student_number', 'desc')
                    ->value('student_number');

                $nextNumber = 1;
                if ($latestStudentNumber) {
                    $lastSequence = (int) substr($latestStudentNumber, strlen($yearPrefix));
                    $nextNumber = $lastSequence + 1;
                }

                // Generate a unique student number for this year.
                do {
                    $studentNumber = $yearPrefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
                    $nextNumber++;
                } while (Student::where('student_number', $studentNumber)->exists());


                return Student::create(array_merge($validated, [
                    'student_number' => $studentNumber,
                    'photo' => $photoPath,
                ]));
            });
        } catch (\Throwable $e) {
            // Clean up newly uploaded file if database operation fails.
            if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }
            throw $e;
        }


        return redirect()
            ->route('students.show', $student->id)
            ->with('success', 'Student successfully registered.');
    }


    /** Display student details. */
    public function show(Student $student)
    {
        $student->load(['enrollments.subject']);
        return view('students.show', compact('student'));
    }


    /** Show edit form, including active courses for the dropdown. */
    public function edit(Student $student)
    {
        $courses = Course::where('is_active', true)
            ->orderBy('course_name', 'asc')
            ->get();


        return view('students.edit', compact('student', 'courses'));
    }


    /** Update student information and optional photo. */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'first_name'     => ['required', 'string', 'max:100'],
            'middle_name'    => ['nullable', 'string', 'max:100'],
            'last_name'      => ['required', 'string', 'max:100'],
            'gender'         => ['nullable', Rule::in(['Male', 'Female'])],
            'birth_date'     => ['nullable', 'date', 'before_or_equal:today'],
            'email'          => ['nullable', 'email', 'max:150'],
            'contact_number'  => ['nullable', 'string', 'max:30'],
            'address'        => ['nullable', 'string', 'max:1000'],
            'course'         => ['required', 'string', 'max:150'],
            'year_level'     => ['required', 'integer', 'min:1', 'max:6'],
            'photo'          => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // Do not mass-assign the temporary UploadedFile object into photo.
        unset($validated['photo']);


        $oldPhoto = $student->photo;
        $newPhotoPath = null;
        $removePhoto = $request->boolean('remove_photo');


        // Store the uploaded file permanently and get its relative path.
        if ($request->hasFile('photo')) {
            $newPhotoPath = $request->file('photo')->store('students', 'public');
        }


        try {
            DB::transaction(function () use ($student, $validated, $newPhotoPath, $removePhoto) {
                if ($removePhoto && !$newPhotoPath) {
                    $student->photo = null;
                }

                if ($newPhotoPath) {
                    $student->photo = $newPhotoPath;
                }

                // Fill only validated non-file fields, preserving the stored photo path.
                $student->fill($validated);
                $student->save();
            });
        } catch (\Throwable $e) {
            // Delete newly uploaded image if saving the student fails.
            if ($newPhotoPath) {
                Storage::disk('public')->delete($newPhotoPath);
            }
            throw $e;
        }


        // Delete previous photo only after the database update succeeds.
        if ($oldPhoto && ($removePhoto || $newPhotoPath) && $oldPhoto !== $student->photo) {
            Storage::disk('public')->delete($oldPhoto);
        }


        return redirect()
            ->route('students.show', $student->id)
            ->with('success', 'Student information successfully updated.');
    }


    /** Delete student. Prevent deletion when enrollment records exist. */
    public function destroy(Student $student)
    {
        if ($student->enrollments()->exists()) {
            return redirect()
                ->route('students.index')
                ->with('error', 'Cannot delete this student because enrollment records exist. Remove or manage the enrollments first.');
        }


        // Delete student's stored photo file.
        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }


        $student->delete();


        return redirect()
            ->route('students.index')
            ->with('success', 'Student successfully deleted.');
    }
}
