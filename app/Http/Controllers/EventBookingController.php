<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketMail;

class EventBookingController extends Controller
{
    // For authenticated user booking
  public function book(Request $request)
{
    $request->validate([
        'event_id' => 'required|exists:events,id',
    ]);

    $event = Event::findOrFail($request->event_id);
    $user = Auth::user();

    // ✅ Prevent null user access
    if (!$user) {
        return redirect()->back()->with('error', 'You must be logged in to book this event.');
    }

    if (Booking::where('user_id', $user->id)->where('event_id', $event->id)->exists()) {
        return redirect()->back()->with('error', 'You have already booked this event.');
    }

    $booking = Booking::create([
        'user_id' => $user->id,
        'event_id' => $event->id,
        'name' => $user->name,
        'email' => $user->email,
    ]);

    Mail::to($user->email)->send(new TicketMail($booking));

    return redirect()->back()->with('success', 'Booking successful! Ticket sent to your email.');
}


   
    public function create(Event $event)
    {
        return view('bookings.create', compact('event'));
    }

    // Store guest booking and send ticket
    public function store(Request $request, Event $event)
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->back()->with('error', 'You must be logged in to book this event.');
    }

    if (Booking::where('user_id', $user->id)->where('event_id', $event->id)->exists()) {
        return redirect()->back()->with('error', 'You have already booked this event.');
    }

    $booking = Booking::create([
        'user_id' => $user->id,
        'event_id' => $event->id,
        'name' => $user->name,
        'email' => $user->email,
    ]);

    Mail::to($user->email)->send(new TicketMail($booking));

    return redirect()->route('events.book', $event->id)
                     ->with('success', 'Booking successful! Ticket sent to your email.');
}

}
