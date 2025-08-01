@extends("layouts.default")
@section("content")
    <div class="event-container">

        <!-- Event Card 1 -->
        <div class="event-card">
            <img src="assets/images/download.jpg" alt="Event 1 Poster" class="event-poster">
            <h3 class="event-title">Music Festival 2025</h3>
            <p class="event-price">₹500</p>
        </div>

        <!-- Event Card 2 -->
        <div class="event-card">
            <img src="/images/event2.jpg" alt="Event 2 Poster" class="event-poster">
            <h3 class="event-title">Food Carnival</h3>
            <p class="event-price">₹300</p>
        </div>

        <!-- Event Card 3 -->
        <div class="event-card">
            <img src="/images/event3.jpg" alt="Event 3 Poster" class="event-poster">
            <h3 class="event-title">Tech Conference</h3>
            <p class="event-price">₹1,200</p>
        </div>

    </div>

@endsection