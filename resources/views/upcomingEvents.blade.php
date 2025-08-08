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
        <h1 class="page-title">UCPOMING EVENTS</h1>

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
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>
