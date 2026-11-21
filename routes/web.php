<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CourseController;



Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('students', StudentController::class);

    Route::resource('subjects', SubjectController::class);

   // ENROLLMENT GROUP ROUTES - MUST BE BEFORE RESOURCE ROUTES

    Route::get('/enrollments/group/show', [EnrollmentController::class, 'groupShow'])
        ->name('enrollments.groupShow');

    Route::get('/enrollments/group/edit', [EnrollmentController::class, 'groupEdit'])
        ->name('enrollments.groupEdit');

    Route::put('/enrollments/group/update', [EnrollmentController::class, 'groupUpdate'])
        ->name('enrollments.groupUpdate');

    Route::delete('/enrollments/group/delete', [EnrollmentController::class, 'groupDestroy'])
        ->name('enrollments.groupDestroy');

    // ENROLLMENT RESOURCE ROUTES - AFTER GROUP ROUTES

    Route::resource('enrollments', EnrollmentController::class)
        ->except(['show']);


        Route::post('/profile/password', [ProfileController::class, 'updatePassword'])
       ->name('profile.password.update');


});

 // ADD COURSE MANAGEMENT HERE
    Route::resource('courses', CourseController::class)
        ->except(['show']);

    Route::patch('/courses/{course}/toggle-status', [CourseController::class, 'toggleStatus'])
        ->name('courses.toggleStatus');

require __DIR__.'/auth.php';



