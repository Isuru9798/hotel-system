<?php

use App\Http\Controllers\bill\LaundryBillController;
use App\Http\Controllers\bill\RestaurantBillController;
use App\Http\Controllers\bill\RoomBillController;
use App\Http\Controllers\bill\TaxiBillController;
use App\Http\Controllers\checkIn\CheckInController;
use App\Http\Controllers\checkOut\CheckOutController;
use App\Http\Controllers\invoice\invoiceController;
use App\Http\Controllers\mainAdmin\MainAdminController;
use App\Http\Controllers\QR\QRController;
use App\Http\Controllers\restaurant\ItemsController;
use App\Http\Controllers\Rooms\RoomController;
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
        Route::post('crop-image-upload', [ItemsController::class, 'img'])->name('img');
        Route::post('add-item', [ItemsController::class, 'store'])->name('item.add');
        Route::get('get-item/{id}', [ItemsController::class, 'getById'])->name('item.getById');
        Route::post('update-item/{id}', [ItemsController::class, 'update'])->name('item.update');
        Route::get('delete-item/{id}', [ItemsController::class, 'delete'])->name('item.delete');

        // check in
        Route::get('check-in', [CheckInController::class, 'index'])->name('checkIn');
        Route::post('get-guest', [CheckInController::class, 'findGuest'])->name('findGuest');
        Route::post('add-check-in', [CheckInController::class, 'store'])->name('checkIn.add');
        Route::get('get-check-in/{id}', [CheckInController::class, 'getById'])->name('checkIn.getById');
        Route::get('cancel-check-in/{id}', [CheckInController::class, 'cancelCheckIn'])->name('checkIn.cancel');
        // Route::post('delete-check-in/{id}', [CheckInController::class, 'delete'])->name('checkIn.delete');


        // room bills
        Route::get('room-bills', [RoomBillController::class, 'index'])->name('room-bills');
        Route::post('get-data-by-room-id', [RoomBillController::class, 'getDataByRoom'])->name('room-bills.getByRoom');
        Route::post('add-room-bill', [RoomBillController::class, 'store'])->name('room-bill.add');
        Route::get('cancel-room-bill/{id}', [RoomBillController::class, 'cancel'])->name('room-bill.cancel');


        // taxi bills
        Route::get('taxi-bills', [TaxiBillController::class, 'index'])->name('taxi-bills');
        // Route::post('get-data-by-room-id', [RoomBillController::class, 'getDataByRoom'])->name('room-bills.getByRoom');
        Route::post('add-taxi-bill', [TaxiBillController::class, 'store'])->name('taxi-bill.add');
        Route::get('cancel-taxi-bill/{id}', [TaxiBillController::class, 'cancel'])->name('taxi-bill.cancel');


        // laundry bills
        Route::get('laundry-bills', [LaundryBillController::class, 'index'])->name('laundry-bills');
        // Route::post('get-data-by-room-id', [RoomBillController::class, 'getDataByRoom'])->name('room-bills.getByRoom');
        Route::post('add-laundry-bill', [LaundryBillController::class, 'store'])->name('laundry-bill.add');
        Route::get('cancel-laundry-bill/{id}', [LaundryBillController::class, 'cancel'])->name('laundry-bill.cancel');

        // restaurant bills
        Route::get('restaurant-bills', [RestaurantBillController::class, 'index'])->name('restaurant-bills');
        // Route::post('get-data-by-room-id', [RoomBillController::class, 'getDataByRoom'])->name('room-bills.getByRoom');
        Route::post('add-restaurant-bill', [RestaurantBillController::class, 'store'])->name('restaurant-bill.add');
        Route::post('get-restaurant-item-data', [RestaurantBillController::class, 'getItemData'])->name('restaurant-bills.getItem-data');
        Route::get('cancel-restaurant-bill/{id}', [RestaurantBillController::class, 'cancel'])->name('restaurant-bill.cancel');


        // checkout
        Route::get('check-out', [CheckOutController::class, 'index'])->name('checkOut');
        Route::post('check-out-room-bills', [CheckOutController::class, 'getBills'])->name('checkOut.bills');
        Route::post('check-out-store', [CheckOutController::class, 'checkout'])->name('checkOut.store');


        // invoice
        Route::get('invoice', [invoiceController::class, 'index'])->name('invoice');
        Route::get('invoice-view/{id}', [invoiceController::class, 'invoice'])->name('invoice-view');
    });
});
Route::get('item-list-rooms/{id}', [QRController::class, 'index'])->name('qr-code.item-list');
