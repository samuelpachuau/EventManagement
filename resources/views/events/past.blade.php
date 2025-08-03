@extends('layouts.default')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">📅 Past Events</h2>

    @if($pastEvents->isEmpty())
        <div class="alert alert-info text-center">
            No past events found.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($pastEvents as $event)
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}
                            </h6>
                            <p class="card-text">
                                {{ $event->description }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $pastEvents->links() }}
        </div>
    @endif
</div>
@endsection
