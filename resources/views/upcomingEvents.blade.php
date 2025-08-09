<!DOCTYPE html>
<html>
<head>
    <title>Upcoming Events</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="upcoming-events-body">

    <nav class="navbar">
        <div class="navbar-brand">Get Your Tickets</div>
        <ul class="navbar-links">
            <li class="search-container">
                <form action="{{ url('/search') }}" method="GET" style="display: flex;">
                    <input type="text" name="q" placeholder="Search..." class="search-input">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </li>
            <li>
                <a href="{{ route('upcomingEvents') }}" class="upcoming-events-link">Upcoming Events</a>
            </li>
            @guest
            <li>
                <a href="{{ route('register') }}" class="register-link">Register</a>
            </li>
            @endguest
            @auth
            <li class="dropdown">
                <a href="#" class="profile-link">
                    <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('myprofile') }}">My Profile</a></li>
                    <li><a href="{{ route('past.events') }}">Past Events</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
            @endauth
        </ul>
    </nav>

    @if(session()->has("success"))
        <div class="alert alert-success">
            {{ session()->get("success") }}
        </div>
    @endif
    @if(session()->has("error"))
        <div class="alert alert-danger">
            {{ session()->get("error") }}
        </div>
    @endif

    <div class="container">
        <h1 class="page-title">UPCOMING EVENTS</h1>

        @if($events->isEmpty())
            <p class="no-events-message">No upcoming events right now.</p>
        @else
            <div class="events-grid">
                @foreach($events as $event)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" 
                                 alt="{{ $event->name }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-300 flex items-center justify-center text-gray-500">
                                No Image
                            </div>
                        @endif

                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $event->name }}</h2>
                            <p class="text-gray-600 text-sm mb-2">{{ $event->location }}</p>
                            <p class="text-gray-500 text-sm mb-4">
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, h:i A') }}
                            </p>

                            <a href="{{ route('events.show', $event->id) }}"
                               class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm mr-2">
                                View Details
                            </a>
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
