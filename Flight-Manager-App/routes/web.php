<?php

use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;

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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');

Route::get('/register', [AuthController::class, 'registration'])->name('register');
Route::post('/register', [AuthController::class, 'postRegistration'])->name('register.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

// Tickets
Route::get('/tickets/booked', [ProfileController::class, 'index'])->name('booked.tickets');


// Ticket
Route::get('/ticket/{ticket}', [FlightController::class, 'getTicket'])->name('ticket');
Route::get('/ticket/{ticket}/reserve/guest', [FlightController::class, 'reserveTicketNoneUser'])->name('ticket.reserve.guest');


Route::get('/ticket/{ticket}/checkout/{reservedTicket}/{guest?}', [CheckoutController::class, 'checkout'])->name('ticket.checkout');
Route::post('/ticket/{ticket}/checkout/{reservedTicket}/{guest?}', [CheckoutController::class, 'postCheckout'])->name('ticket.checkout.post');
