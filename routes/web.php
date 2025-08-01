<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::get('/past-events', [EventController::class, 'pastEvents'])->name('past.events');

Route::get('/settings', function () {
    return view('settings'); // Make sure you have a settings.blade.php view
})->name('settings');


Route::get('/upcoming-events', [EventController::class, 'upcomingEvents'])->name('upcomingEvents');


Route::get('/', function () {
    if (Auth::check()) {
        return view('home'); // for logged-in users
    } else {
        return view('index'); // for guests
    }
})->name('home');

// Auth routes
Route::get('login', [AuthManager::class, 'login'])->name('login');
Route::post('login', [AuthManager::class, 'loginPost'])->name('login.post');

Route::get('register', [AuthManager::class, 'register'])->name('register');
Route::post('register', [AuthManager::class, 'registerPost'])->name('register.post');

// Events resource controller
Route::resource('events', EventController::class);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'Logged out successfully.');
})->name('logout');
