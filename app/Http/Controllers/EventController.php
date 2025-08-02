<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



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
    $pastEvents = Event::where('date', '<', Carbon::now())->get();
    return view('events.past', compact('pastEvents'));
}

}
