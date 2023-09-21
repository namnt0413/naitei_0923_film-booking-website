<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('index');

    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    Route::get('/films/{film}/booking', [TicketController::class, 'renderBooking']);

    Route::get('/tickets/list', [TicketController::class, 'bookedTickets'])->name('tickets.booked');
    Route::get('/tickets/list/{ticket}', [TicketController::class, 'detailTicket'])->name('tickets.detail');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, '__invoke'])->name('dashboard');
    Route::resource('screenings', ScreeningController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('seats', SeatController::class);
    Route::resource('films', FilmController::class);
    Route::resource('tickets', TicketController::class)->except(['store', 'destroy']);
    Route::resource('users', UserController::class)->only(['index', 'show', 'update']);
});

Route::get('/seats/{room}/search', [SeatController::class, 'searchByRoom']);
Route::get('/screenings/{room}/search', [ScreeningController::class, 'searchByRoom']);

require __DIR__.'/auth.php';
