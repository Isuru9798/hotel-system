<?php

use App\Http\Controllers\mainAdmin\MainAdminController;
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
    Route::get('/', function () {
        return redirect()->route('mainAdmin.dashboard');
    });
    Route::middleware(['isMainAdmin', 'auth', 'prvBackHistory'])->group(function () {
        Route::get('dashboard', [MainAdminController::class, 'index'])->name('mainAdmin.dashboard');
    });
});
