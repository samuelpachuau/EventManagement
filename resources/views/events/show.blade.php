@extends('layouts.default')

@section('title', $event->name)
@section('body-class', 'event-details-body')

@section('content')
<div class="event-details-container">
    <div class="event-details-card">
        <div class="event-details-image">
            @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}">
            @else
                <div class="no-image">No Image Available</div>
            @endif
        </div>
        <div class="event-details-info">
            <h1>{{ $event->name }}</h1>
            <p class="description">{{ $event->description }}</p>
            <p class="location">📍{{ $event->location }}</p>
            <p class="datetime">📅
                {{ $event->start_date->format('d M Y, h:i A') }} -
                {{ $event->end_date->format('d M Y, h:i A') }}
            </p>
            
            <p class="organizer">Organized by: {{ $event->organizer->name ?? 'N/A' }}</p>
             <a href="{{ route('book.event', $event->id) }}" class="book-now-btn">Book Now</a>
        </div>
    </div>
</div>
@endsection
