<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Ticket</title>
    <style>
        body {
            font-family:  sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 20px;
        }

        .ticket {
            border: 1px solid #000;
            padding: 20px;
            width: 100%;
        }

        .ticket h2 {
            margin-top: 0;
            text-align: center;
        }

        .ticket p {
            margin: 5px 0;
        }

        .qr-code {
            margin-top: 20px;
            text-align: center;
        }

        .qr-code img {
            width: 150px;
            height: 150px;
        }
    </style>
</head>
<body>
    <div class="ticket">
     <h2>{{ $booking->event?->name ?? 'Event Title' }} - Ticket</h2>
<p><strong>Date:</strong> {{ $booking->event?->start_date ?? 'N/A' }}</p>
<p><strong>Location:</strong> {{ $booking->event?->location ?? 'N/A' }}</p>



        <div class="qr-code">
            <p><strong>Scan at Entry</strong></p>
            <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code">
        </div>
    </div>
</body>
</html>
