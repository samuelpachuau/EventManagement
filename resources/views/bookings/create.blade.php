@extends('layouts.default') {{-- Or your layout file --}}

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 mt-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Book: {{ $event->name }}</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('events.book.store', $event->id) }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium">Name</label>
            <input type="text" name="name" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Confirm Booking
        </button>
    </form>
</div>
@endsection
