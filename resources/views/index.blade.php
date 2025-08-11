<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Huau</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <nav class="navbar">
        <div class="navbar-brand">Get Your Tickets</div>
        <ul class="navbar-links">
            {{-- Search Bar --}}
            <li class="search-container">
                <form action="{{ url('/search') }}" method="GET" style="display: flex;">
                    <input type="text" name="q" placeholder="Search..." class="search-input">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </li>

            {{-- Common Link for Everyone --}}
            <li><a href="{{ route('upcomingEvents') }}" class="upcoming-events-link">Upcoming Events</a></li>

            {{-- Guest Links --}}
            @guest
                <li><a href="{{ route('register') }}" class="register-link">Register</a></li>
            @endguest

            {{-- Authenticated User Links --}}
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
        {{-- Your page content can go here --}}
    </div>

</body>
</html>
