<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'postLogin'])->name('login.post');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/admin', [\App\Http\Controllers\DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/dashboard/teacher', [\App\Http\Controllers\DashboardController::class, 'teacher'])->name('teacher.dashboard');
    Route::get('/dashboard/student', [\App\Http\Controllers\DashboardController::class, 'student'])->name('student.dashboard');

    Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [UserController::class, 'updatePassword'])->name('password.change.update');
});

Route::view('/landing', 'landing')->name('home')->middleware('promotion');

Route::middleware(['access.control'])->group(function () {
    // Route::get('/students/home', [StudentController::class, 'home'])->name('students.home');
    // Route::get('/students/page', [StudentController::class, 'page'])->name('students.page');
    // Route::get('/students/aboutus', [StudentController::class, 'aboutUs'])->name('students.aboutus');
    // Route::get('/students/activity-logs', [ActivityLogController::class, 'index'])->name('students.activity-logs');
    // Route::resource('courses', CourseController::class);
    // Route::get('enrollment', [CourseController::class, 'enrollView'])->name('courses.enroll.view');
    // Route::post('enrollment', [CourseController::class, 'enroll'])->name('courses.enroll');
    // Route::resource('users', UserController::class);
    // Route::resource('posts', PostController::class);
    // Route::resource('degrees', DegreeController::class);
    // Route::resource('students', StudentController::class);
});

 Route::get('/students/home', [StudentController::class, 'home'])->name('students.home');
    Route::get('/students/page', [StudentController::class, 'page'])->name('students.page');
    Route::get('/students/aboutus', [StudentController::class, 'aboutUs'])->name('students.aboutus');
    Route::get('/students/activity-logs', [ActivityLogController::class, 'index'])->name('students.activity-logs');
    Route::resource('courses', CourseController::class);
    Route::get('enrollment', [CourseController::class, 'enrollView'])->name('courses.enroll.view');
    Route::post('enrollment', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::resource('users', UserController::class);
    Route::resource('posts', PostController::class);
    Route::resource('degrees', DegreeController::class);
    Route::resource('students', StudentController::class);

Route::resource('client', ClientController::class);

Route::get('/maintenance', [PagesController::class, 'maintenace'])->name('maintenance');
