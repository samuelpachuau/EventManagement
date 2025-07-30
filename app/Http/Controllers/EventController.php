<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        
        $events = Event::where('name', 'like', "%{$query}%")->get();

        return view('events.index', compact('events', 'query'));
    }
}
