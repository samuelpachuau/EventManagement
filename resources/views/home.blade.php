<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Huau</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-links {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .navbar-links li {
            position: relative;
        }

        .navbar-links a {
            text-decoration: none;
            color: #333;
        }

        .search-container input {
            padding: 5px;
        }

        .search-btn {
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 120%;
            right: 0;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            list-style: none;
            min-width: 160px;
            padding: 0.5rem 0;
            z-index: 100;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu li {
            padding: 0.5rem 1rem;
        }

        .dropdown-menu li a,
        .dropdown-menu li form button {
            color: #333;
            text-decoration: none;
            display: block;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .dropdown-menu li a:hover,
        .dropdown-menu li form button:hover {
            background-color: #f1f1f1;
        }

        .profile-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert {
            padding: 1rem;
            margin: 1rem;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

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

            <li><a href="{{ route('upcomingEvents') }}" class="upcoming-events-link">Upcoming Events</a></li>

            @guest
                <li><a href="{{ route('register') }}" class="register-link">Register</a></li>
                <li><a href="{{ route('login') }}" class="login-link">Login</a></li>
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
        <!-- Optional content here -->
    </div>

</body>
</html>
