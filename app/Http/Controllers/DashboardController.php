<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // =========================
        // DASHBOARD STATISTICS
        // =========================
        $totalStudents = Student::count();
        $totalSubjects = Subject::count();
        $totalEnrollments = Enrollment::count();
        $totalUsers = User::count();

        // =========================
        // ENROLLMENT STATUS
        // =========================
        $activeEnrollments = Enrollment::where('status', 'Active')->count();

        $inactiveEnrollments = Enrollment::where('status', 'Inactive')->count();

        // =========================
        // STUDENTS BY COURSE
        // students.course is VARCHAR
        // =========================
        $studentsByCourse = Student::select(
                'course',
                DB::raw('COUNT(*) as total_students')
            )
            ->whereNotNull('course')
            ->where('course', '!=', '')
            ->groupBy('course')
            ->orderByDesc('total_students')
            ->get();

        // =========================
        // STUDENT GENDER DISTRIBUTION
        // =========================
        $maleStudents = Student::whereRaw('LOWER(TRIM(gender)) = ?', ['male'])
            ->count();

        $femaleStudents = Student::whereRaw('LOWER(TRIM(gender)) = ?', ['female'])
            ->count();

        $genderTotal = $maleStudents + $femaleStudents;

        $malePercentage = $genderTotal > 0
            ? ($maleStudents / $genderTotal) * 100
            : 0;

        $femalePercentage = $genderTotal > 0
            ? ($femaleStudents / $genderTotal) * 100
            : 0;

        // =========================
        // RECENT ENROLLMENTS
        // Group by student + school year + semester
        // =========================
        $recentEnrollments = DB::table('enrollments')
            ->join('students', 'enrollments.student_id', '=', 'students.id')
            ->leftJoin('subjects', 'enrollments.subject_id', '=', 'subjects.id')
            ->select(
                'students.id as student_id',
                'students.student_number',
                'students.first_name',
                'students.middle_name',
                'students.last_name',
                'enrollments.school_year',
                'enrollments.semester',
                DB::raw('COUNT(enrollments.id) as total_subjects'),
                DB::raw('COALESCE(SUM(subjects.units), 0) as total_units'),
                DB::raw('MIN(enrollments.enrollment_date) as enrolled_date'),
                'enrollments.status'
            )
            ->groupBy(
                'students.id',
                'students.student_number',
                'students.first_name',
                'students.middle_name',
                'students.last_name',
                'enrollments.school_year',
                'enrollments.semester',
                'enrollments.status'
            )
            ->orderByDesc('enrolled_date')
            ->limit(5)
            ->get();

        // =========================
        // RETURN DASHBOARD
        // =========================
        return view('dashboard', compact(
            'totalStudents',
            'totalSubjects',
            'totalEnrollments',
            'totalUsers',
            'activeEnrollments',
            'inactiveEnrollments',
            'studentsByCourse',
            'maleStudents',
            'femaleStudents',
            'genderTotal',
            'malePercentage',
            'femalePercentage',
            'recentEnrollments'
        ));
    }
}
