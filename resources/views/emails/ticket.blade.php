
@php
    $event = $booking->event;
@endphp

<p>Hello {{ $booking->user->name ?? 'Guest' }},</p>

<p>Thank you for booking <strong>{{ $event->title ?? '***' }}</strong>.</p>

<p>📅 <strong>Date:</strong> {{ $event->start_date ?? 'Not available' }}</p>
<p>📍 <strong>Location:</strong> {{ $event->location ?? 'Not available' }}</p>

<p>Your ticket is attached as a PDF.</p>

<p>Thanks,<br>Laravel</p>
