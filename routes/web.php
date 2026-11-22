
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // STUDENT MANAGEMENT
    Route::resource('students', StudentController::class);

    // SUBJECT MANAGEMENT
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

    // ENROLLMENT RESOURCE ROUTES
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

});

require __DIR__.'/auth.php';
