@extends('layouts.default')

@section('content')
<div style="min-height: 100vh; display: flex; align-items: flex-start; justify-content: center; background-color: #f3f4f6; padding-top: 4rem;">
    <div style="max-width: 36rem; width: 100%; background: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <h2 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 1rem;">
            Book: {{ $event->name }}
        </h2>

        @if(session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 0.5rem 1rem; border-radius: 0.25rem; margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('events.book.store', $event->id) }}">
            @csrf

            <p style="margin-bottom: 1rem; color: #374151;">
                🎟️ Ticket will be sent to:
                <span style="font-weight: 600;">{{ Auth::user()->name }}</span>
                (<span style="color: #2563eb;">{{ Auth::user()->email }}</span>)
            </p>

            <button type="submit" style="background: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.25rem; cursor: pointer;">
                Confirm Booking
            </button>
        </form>
    </div>
</div>
@endsection
