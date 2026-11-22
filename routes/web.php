<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\UserManagementController;

// =========================================
// PUBLIC ROUTES
// =========================================

Route::get('/', function () {
    return redirect()->route('dashboard');
});


// =========================================
// AUTHENTICATED ROUTES
// =========================================

Route::middleware('auth')->group(function () {

    // =========================================
    // DASHBOARD
    // =========================================

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // =========================================
    // STUDENT MANAGEMENT
    // =========================================

    Route::resource('students', StudentController::class);


    // =========================================
    // SUBJECT MANAGEMENT
    // =========================================

    Route::resource('subjects', SubjectController::class);


    // =========================================
    // ENROLLMENT GROUP ROUTES
    // MUST BE BEFORE RESOURCE ROUTES
    // =========================================

    Route::get('/enrollments/group/show', [EnrollmentController::class, 'groupShow'])
        ->name('enrollments.groupShow');

    Route::get('/enrollments/group/edit', [EnrollmentController::class, 'groupEdit'])
        ->name('enrollments.groupEdit');

    Route::put('/enrollments/group/update', [EnrollmentController::class, 'groupUpdate'])
        ->name('enrollments.groupUpdate');

    Route::delete('/enrollments/group/delete', [EnrollmentController::class, 'groupDestroy'])
        ->name('enrollments.groupDestroy');


    // =========================================
    // ENROLLMENT RESOURCE ROUTES
    // =========================================

    Route::resource('enrollments', EnrollmentController::class)
        ->except(['show']);


    // =========================================
    // PROFILE / PASSWORD
    // =========================================

    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');


    // =========================================
    // AI ENGINEERING PORTFOLIO
    // =========================================

    Route::get('/portfolio', function () {
        return view('portfolio.index');
    })->name('portfolio');


    // =========================================
    // COURSE MANAGEMENT
    // =========================================

    Route::resource('courses', CourseController::class)
        ->except(['show']);

    Route::patch('/courses/{course}/toggle-status', [CourseController::class, 'toggleStatus'])
        ->name('courses.toggleStatus');


    // =========================================
    // USER REGISTRATION
    // =========================================

    Route::get('/user-registration', function () {
        return view('user-registration');
    })->name('user-registration');


    // =========================================
    // USER MANAGEMENT
    // =========================================

    Route::get('/user-management', [UserManagementController::class, 'index'])
        ->name('user-management.index');

    Route::get('/user-management/{user}/edit', [UserManagementController::class, 'edit'])
        ->name('user-management.edit');

    Route::put('/user-management/{user}', [UserManagementController::class, 'update'])
        ->name('user-management.update');

    Route::post('/user-registration', [UserManagementController::class, 'store'])
        ->name('user-registration.store');

    // =========================================
    // ACTIVATE / DEACTIVATE USER ACCOUNT
    // PROTECTED BY AUTH MIDDLEWARE
    // =========================================

    Route::patch('/user-management/{user}/status', [UserManagementController::class, 'toggleStatus'])
        ->name('user-management.toggle-status');

});


// =========================================
// AUTHENTICATION ROUTES
// =========================================

require __DIR__.'/auth.php';