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
            <li>
                <a href="{{ route('register') }}" class="register-link">Register</a>
            </li>
        </ul>
    </nav>



</body>
</html>
