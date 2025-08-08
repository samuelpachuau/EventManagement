<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketMail;
use Carbon\Carbon;

class EventController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->only(['book', 'pastEvents']);
    }

<<<<<<< HEAD
    
    public function upcomingEvents()
    {
        $events = Event::where('start_date', '>=', Carbon::now())
            ->orderBy('start_date', 'asc')
            ->get();

        return view('upcomingEvents', compact('events'));
    }

    
    public function book(Request $request)
{
    $request->validate([
        'event_id' => 'required|exists:events,id',
    ]);

    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->withErrors('Please login to book an event.');
    }

    $booking = new Booking();
    $booking->user_id = $user->id; // ✅ Corrected here
    $booking->event_id = $request->event_id;
    $booking->save();

    $booking->load(['event', 'user']);

    if ($booking->user && $booking->user->email) {
        Mail::to($booking->user->email)->send(new TicketMail($booking));
    }

    return redirect()->back()->with('success', 'Booking confirmed. Ticket sent to your email.');
}

public function pastEvents()
{
    $user = Auth::user();
    

    if (!$user) {
        return redirect()->route('login')->withErrors('Please login to view past events.');
    }

    $now = Carbon::now();

    $pastEvents = Event::whereIn('id', function ($query) use ($user) {
        $query->select('event_id')
            ->from('bookings')
            ->where('user_id', $user->id);
    })
    ->whereDate('end_date', '<=', \Carbon\Carbon::today())
    ->orderBy('date', 'desc')
    ->paginate(10);

    return view('events.past', compact('pastEvents'));
}




   
   


}
=======
    public function index()
    {
        $events = Event::latest()->get();
        return view('index', compact('events')); // or 'index' if you're using that
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
>>>>>>> 57f52a8e0a2be49e34503b56c2f3088e8813c8d3
