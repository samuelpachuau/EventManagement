<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

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
        return view('index',compact('events'));
    }
}
