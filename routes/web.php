<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventBookingController;
use App\Http\Controllers\ProfileController;
use App\Models\Booking;
use App\Models\Event;

// Public Routes
Route::get('/', function () {
    return Auth::check() ? view('home') : view('index');
})->name('home');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');

Route::get('/register', [AuthManager::class, 'register'])->name('register');
Route::post('/register', [AuthManager::class, 'registerPost'])->name('register.post');

Route::get('/upcoming-events', [EventController::class, 'upcomingEvents'])->name('upcomingEvents');

// Protected Routes
Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/myprofile', [ProfileController::class, 'show'])->name('myprofile');
    Route::get('/myprofile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/myprofile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/myprofile/password', [ProfileController::class, 'changePassword'])->name('profile.password');

    // Event Bookings
    Route::get('/events/{event}/book', [EventBookingController::class, 'create'])->name('events.book');
    Route::post('/events/{event}/book', [EventBookingController::class, 'store'])->name('events.book.store');

    // Past Events
    Route::get('/past-events', [EventController::class, 'pastEvents'])->name('events.past');

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/')->with('success', 'Logged out successfully.');
    })->name('logout');

    // Debug Booking Info (for development only)
    Route::get('/debug-booking', function () {
        $booking = Booking::latest()->first();

        return [
            'booking_id'   => $booking->id,
            'event_id'     => $booking->event_id,
            'event_exists' => Event::find($booking->event_id) ? true : false,
        ];
    });

    // Test PDF (for development only)
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
});

// Admin/CRUD Events (could be protected further with admin middleware)
Route::resource('events', EventController::class);
