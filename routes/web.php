<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventBookingController;
use App\Models\Booking;
use App\Models\Event;

Route::get('/myprofile', [ProfileController::class, 'show'])->name('myprofile');
Route::get('/myprofile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/myprofile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/myprofile/password', [ProfileController::class, 'changePassword'])->name('profile.password');


Route::get('/', function () {
    $events = Event::latest()->get();
    return view('index', compact('events')); // home.blade.php handles both cases
})->name('home');



Route::get('/past-events', [EventController::class, 'pastEvents'])->name('past.events');


Route::get('/myprofile', function () {
    $user = Auth::user();  // get the currently logged-in user
    return view('myprofile', compact('user'));
})->name('myprofile')->middleware('auth');


Route::get('/upcoming-events', [EventController::class, 'upcomingEvents'])->name('upcomingEvents');


// Auth routes
Route::get('login', [AuthManager::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [AuthManager::class, 'loginPost'])->name('login.post');

Route::get('register', [AuthManager::class, 'register'])->name('register')->middleware('guest');
Route::post('register', [AuthManager::class, 'registerPost'])->name('register.post');

// Events resource controller
Route::resource('events', EventController::class);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'Logged out successfully.');
})->name('logout');



Route::get('/events/{event}/book', [EventBookingController::class, 'create'])->name('events.book');
Route::post('/events/{event}/book', [EventBookingController::class, 'store'])->name('events.book.store');

Route::get('/debug-booking', function () {
    $booking = Booking::latest()->first(); // get latest booking

    return [
        'booking_id'   => $booking->id,
        'event_id'     => $booking->event_id,
        'event_exists' => Event::find($booking->event_id) ? true : false,
    ];
});
Route::get('/test-pdf/{id}', function ($id) {
    $booking = \App\Models\Booking::with(['event', 'user'])->findOrFail($id);

    $qrCode = base64_encode(
        \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(150)->generate('Ticket#' . $booking->id)
    );

    return PDF::loadView('tickets.template', [
        'booking' => $booking,
        'qrCode' => $qrCode,
    ])->download('test.pdf');
});


Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');