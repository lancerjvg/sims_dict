<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Enrollment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();

        $totalSubjects = Subject::count();

        $totalEnrollments = Enrollment::count();

        $activeEnrollments = Enrollment::where('status', 'Active')->count();

        $totalUsers = User::count();

        return view('dashboard', compact(
            'totalStudents',
            'totalSubjects',
            'totalEnrollments',
            'activeEnrollments',
            'totalUsers'
        ));
    }
}