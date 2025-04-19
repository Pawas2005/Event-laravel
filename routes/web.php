<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\RSVPController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::resource('events', EventController::class);
    Route::resource('guests', GuestController::class);
    Route::resource('rsvps', RSVPController::class);
    
    // Additional routes for event management
    Route::get('events/{event}/guests', [EventController::class, 'guests'])->name('events.guests');
    Route::get('events/{event}/rsvps', [EventController::class, 'rsvps'])->name('events.rsvps');
    Route::post('events/{event}/invite', [EventController::class, 'invite'])->name('events.invite');
    Route::put('rsvps/{rsvp}/update-status', [RSVPController::class, 'updateStatus'])->name('rsvps.update-status');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Guest routes
Route::get('/guest/login', [GuestController::class, 'showLoginForm'])->name('guest.login');
Route::post('/guest/login', [GuestController::class, 'login']);
Route::get('/guest/dashboard', [GuestController::class, 'dashboard'])->name('guest.dashboard');
Route::put('/guest/rsvp/{rsvp}', [GuestController::class, 'updateRsvp'])->name('guest.rsvp.update');
Route::post('/guest/logout', [GuestController::class, 'logout'])->name('guest.logout');

require __DIR__.'/auth.php';
