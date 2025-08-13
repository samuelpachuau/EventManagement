{{-- resources/views/upcomingEvents.blade.php --}}
@extends('layouts.default')

@section('title', 'Upcoming Events')
@section('body-class', 'upcoming-events-body')

@section('content')
    <h1 class="page-title">UPCOMING EVENTS</h1>

    @if($events->isEmpty())
        <p class="no-events-message">No upcoming events right now.</p>
    @else
        <div class="events-grid">
            @foreach($events as $event)
                <a href="{{ route('events.show', $event->id) }}" class="event-card-link">
                    <div class="event-card">
                        <div class="event-image-wrapper">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="event-image">
                            @else
                                <div class="no-image">No Image</div>
                            @endif
                        </div>
                        <div class="event-info">
                            <h2>{{ $event->name }}</h2>
                            <p>{{ $event->location }}</p>
                            <p>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, h:i A') }}</p>


                            <p>Price: ₹{{ number_format($event->price, 2) }}</p>

                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
@endsection

