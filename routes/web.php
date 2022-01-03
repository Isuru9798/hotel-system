<?php

use App\Http\Controllers\mainAdmin\MainAdminController;
use App\Http\Controllers\schoolAdmin\SchoolAdminController;
use App\Http\Controllers\student\StudentController;
use App\Http\Controllers\teacher\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return redirect('login');
});

Route::middleware(['prvBackHistory'])->group(function () {
    Auth::routes(['register' => false]);
});

Route::prefix('main-admin')->group(function () {
    Route::middleware(['isMainAdmin', 'auth', 'prvBackHistory'])->group(function () {
        Route::get('dashboard', [MainAdminController::class, 'index'])->name('mainAdmin.dashboard');
    });
});
Route::prefix('school-admin')->group(function () {
    Route::middleware(['isSchoolAdmin', 'auth', 'prvBackHistory'])->group(function () {
        Route::get('dashboard', [SchoolAdminController::class, 'index'])->name('schoolAdmin.dashboard');
    });
});
Route::prefix('teacher')->group(function () {
    Route::middleware(['isTeacher', 'auth', 'prvBackHistory'])->group(function () {
        Route::get('dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
    });
});
Route::prefix('student')->group(function () {
    Route::middleware(['isStudent', 'auth', 'prvBackHistory'])->group(function () {
        Route::get('dashboard', [StudentController::class, 'index'])->name('student.dashboard');
    });
});
