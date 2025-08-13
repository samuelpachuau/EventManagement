<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketMail;
use Illuminate\Support\Facades\Log;
class EventBookingController extends Controller
{
    /**
     * Handle event booking for authenticated users
     */
    public function book(Request $request, Event $event)
{
    $request->validate([
        'event_id' => 'required|exists:events,id',
    ]);

    $user = Auth::user();

    if (!$user) {
        return back()->with('error', 'You must be logged in to book this event.');
    }

    

    $booking = Booking::create([
        'user_id'  => $user->id,
        'event_id' => $event->id,
        'name'     => $user->name,
        'email'    => $user->email,
    ]);

    $ticket = $booking->ticket()->create([
        'ticket_type' => 'Standard',
        'user_id'     => $user->id,
        'event_id'    => $event->id,
        'price'       => $event->price ?? 100,
        'quantity'    => 1,
        'payment_id'  => null,
    ]);

    $ticket->load('booking.event', 'booking.user');

    Mail::to($user->email)->send(new TicketMail($ticket));

    return back()->with('success', 'Booking successful! Ticket sent to your email.');
}


    public function create(Event $event)
    {
        return view('bookings.create', compact('event'));
    }

    /**
     * Ticket verification by code
     */
    public function directVerify($ticketCode)
    {
        $ticket = Ticket::where('code', $ticketCode)
            ->with(['event', 'user', 'booking'])
            ->first();

        if (!$ticket) {
            return view('tickets.verify', ['status' => 'invalid']);
        }

        $booking = $ticket->booking;

        if ($booking->checked_in) {
            return view('tickets.verify', [
                'status'  => 'already_checked_in',
                'booking' => $booking
            ]);
        }

        // Mark as checked in
        $booking->update(['checked_in' => 1]);

        return view('tickets.verify', [
            'status'  => 'valid',
            'booking' => $booking
        ]);
    }
}
