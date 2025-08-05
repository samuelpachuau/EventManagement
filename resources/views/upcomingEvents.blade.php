<!DOCTYPE html>
<html>
<head>
    <title>Upcoming Events</title>
    @vite('resources/css/app.css') {{-- Only include this if you're using Vite --}}
</head>
<body class="bg-gray-100 py-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center">🎟 Upcoming Events</h1>

        @if($events->isEmpty())
            <p class="text-center text-gray-600">No upcoming events right now.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        {{-- Event Image --}}
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" 
                                 alt="{{ $event->name }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-300 flex items-center justify-center text-gray-500">
                                No Image
                            </div>
                        @endif

                        {{-- Event Info --}}
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $event->name }}</h2>
                            <p class="text-gray-600 text-sm mb-2">{{ $event->location }}</p>
                            <p class="text-gray-500 text-sm mb-4">
                                {{ $event->start_date->format('d M Y, h:i A') }}
                            </p>

                            {{-- Book Now Button --}}
                            <a href="{{ route('events.book', $event->id) }}"
                               class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                Book Now
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
