@extends('layouts.default') <!-- Change to your layout file -->

@section('content')
<div class="container mt-4">
    <h2>Past Events</h2>
    
    @if($pastEvents->isEmpty())
        <p>No past events found.</p>
    @else
        <ul>
            @foreach($pastEvents as $event)
                <li>
                    <strong>{{ $event->name }}</strong><br>
                    Date: {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}<br>
                    Description: {{ $event->description }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
