
<!DOCTYPE html>
<html>
<head>
    <title>Ticket Verification</title>
</head>
<body>
    @if($status === 'valid')
        <h2 style="color:green;">✅ Ticket Valid</h2>
        <p><strong>Event:</strong> {{ $booking->event->name }}</p>
        <p><strong>Date:</strong> {{ $booking->event->start_date }}</p>
        <p><strong>User:</strong> {{ $booking->user->name }} ({{ $booking->user->email }})</p>
        <p>Status: Checked in successfully.</p>
    @elseif($status === 'already_checked_in')
        <h2 style="color:orange;">⚠ Ticket Already Used</h2>
        <p>This ticket was already checked in.</p>
    @else
        <h2 style="color:red;">❌ Invalid Ticket</h2>
    @endif
</body>
</html>
