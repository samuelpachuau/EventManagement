<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
})->name('home');


Route::get('/upcoming-events', [EventController::class, 'upcomingEvents'])->name('upcomingEvents');


Route::get('login', [AuthManager::class, 'login'])->name('login');
Route::post('login', [AuthManager::class, 'loginPost'])->name('login.post');

Route ::get("register",[AuthManager::class,"register"])->name("register");
Route ::post("register",[AuthManager::class,"registerPost"])->name("register.post");
Route::resource('events', EventController::class);
Route::get('/', [EventController::class, 'index'])->name('home');
//Route::resource('tickets', TicketController::class);