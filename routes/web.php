<?php

use App\Http\Controllers\checkIn\CheckInController;
use App\Http\Controllers\mainAdmin\MainAdminController;
use App\Http\Controllers\restaurant\ItemsController;
use App\Http\Controllers\rooms\RoomController;
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

        // rooms
        Route::get('rooms', [RoomController::class, 'index'])->name('rooms');
        Route::post('add-room', [RoomController::class, 'store'])->name('room.add');
        Route::get('get-room/{id}', [RoomController::class, 'getById'])->name('room.getById');
        Route::post('update-room/{id}', [RoomController::class, 'update'])->name('room.update');
        Route::post('delete-room/{id}', [RoomController::class, 'delete'])->name('room.delete');


        // resturent items
        Route::get('items', [ItemsController::class, 'index'])->name('items');
        Route::post('add-item', [ItemsController::class, 'store'])->name('item.add');
        Route::get('get-item/{id}', [ItemsController::class, 'getById'])->name('item.getById');
        Route::post('update-item/{id}', [ItemsController::class, 'update'])->name('item.update');
        Route::post('delete-item/{id}', [ItemsController::class, 'delete'])->name('item.delete');


        Route::get('check-in', [CheckInController::class, 'index'])->name('checkIn');
        Route::post('add-check-in', [CheckInController::class, 'store'])->name('checkIn.add');
        Route::get('get-item/{id}', [CheckInController::class, 'getById'])->name('item.getById');
        Route::post('update-item/{id}', [CheckInController::class, 'update'])->name('item.update');
        Route::post('delete-item/{id}', [CheckInController::class, 'delete'])->name('item.delete');
    });
});
