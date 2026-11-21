<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Display the course management page.
     * Sorted by Course Information (course_name) A-Z.
     */
    public function index(Request $request)
    {
        // Search
        $search = $request->input('search');

        // Status filter
        $status = $request->input('status', 'all');

        // Statistics
        $totalCourses = Course::count();
        $activeCourses = Course::where('is_active', true)->count();
        $inactiveCourses = Course::where('is_active', false)->count();

        // Main query
        $query = Course::query();

        // Search by Course Code or Course Information
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('course_code', 'like', '%' . $search . '%')
                  ->orWhere('course_name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter by status
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        // SORT BY COURSE INFORMATION A-Z
        $query->orderBy('course_name', 'asc');

        // Pagination
        $courses = $query->paginate(10)->withQueryString();

        return view('courses.index', compact(
            'courses',
            'totalCourses',
            'activeCourses',
            'inactiveCourses',
            'search',
            'status'
        ));
    }

    /**
     * Show the Add Course form.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a new course.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => [
                'required',
                'string',
                'size:4',
                'regex:/^[A-Z]{4}$/',
                'unique:courses,course_code',
            ],
            'course_name' => [
                'required',
                'string',
                'max:255',
                'unique:courses,course_name',
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ], [
            'course_code.size' => 'Course Code must be exactly 4 characters.',
            'course_code.regex' => 'Course Code must contain exactly 4 uppercase letters.',
            'course_code.unique' => 'This Course Code already exists.',
            'course_name.unique' => 'This Course Information already exists.',
        ]);

        $validated['course_code'] = strtoupper($validated['course_code']);
        $validated['is_active'] = true;

        Course::create($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course successfully added.');
    }

    /**
     * Show Edit Course form.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update an existing course.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_code' => [
                'required',
                'string',
                'size:4',
                'regex:/^[A-Z]{4}$/',
                Rule::unique('courses', 'course_code')->ignore($course->id),
            ],
            'course_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('courses', 'course_name')->ignore($course->id),
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ], [
            'course_code.size' => 'Course Code must be exactly 4 characters.',
            'course_code.regex' => 'Course Code must contain exactly 4 uppercase letters.',
            'course_code.unique' => 'This Course Code already exists.',
            'course_name.unique' => 'This Course Information already exists.',
        ]);

        $validated['course_code'] = strtoupper($validated['course_code']);

        $course->update($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course successfully updated.');
    }

    /**
     * Toggle Active / Inactive status.
     */
    public function toggleStatus(Course $course)
    {
        $course->is_active = !$course->is_active;
        $course->save();

        $statusText = $course->is_active ? 'activated' : 'deactivated';

        return redirect()
            ->route('courses.index')
            ->with('success', "Course successfully {$statusText}.");
    }

    /**
     * Delete a course.
     * Prevent deletion if students are using this course.
     */
    public function destroy(Course $course)
    {
        // Check if course is currently used by students
        $hasStudents = Student::where('course', $course->course_name)->exists();

        if ($hasStudents) {
            return redirect()
                ->route('courses.index')
                ->with('error', 'This course cannot be deleted because it is currently assigned to students. You may deactivate it instead.');
        }

        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course successfully deleted.');
    }
}
