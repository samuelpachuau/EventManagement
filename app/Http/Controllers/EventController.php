<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Mail\TicketMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Booking;
  






class EventController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        
        $events = Event::where('name', 'like', "%{$query}%")->get();

        return view('events.index', compact('events', 'query'));
    }

    public function index()
    {
        $events = Event::latest()->get();

        if (Auth::check()) {
            return view('home', compact('events')); // if user is logged in
        } else {
            return view('index', compact('events')); // guest view
        }
    }

    public function pastEvents()
    {
        $pastEvents = Event::where('date', '<', Carbon::now())->orderBy('date', 'desc')->paginate(6);

        return view('events.past', compact('pastEvents'));
    }
    public function book(Request $request)
    {
    
        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->event_id = $request->event_id;
        $booking->save();

        
        Mail::to($booking->user->email)->send(new TicketMail($booking));

        return redirect()->back()->with('success', 'Booking confirmed. Ticket sent to your email.');
    }
    public function upcomingEvents()
    {
    
        $events = Event::where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->get();

        return view('upcomingEvents', compact('events'));
    }

    public function show($id)
    {
        $event = Event::find($id);
        return view('events.show',compact('event'));
    }

}