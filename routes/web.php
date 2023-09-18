<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\SeatController;
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

Route::get('/', function () {
    return view('test');
});


Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('screenings', ScreeningController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('seats', SeatController::class);
    Route::get('/dashboard', [DashboardController::class, '__invoke'])->name('dashboard');
});

require __DIR__.'/auth.php';
