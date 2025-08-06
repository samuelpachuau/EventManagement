<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
public function __construct(Booking $booking)
{
    $this->booking = $booking->load(['event', 'user']);
}

    public function build()
{
    $qrCode = base64_encode(
        QrCode::format('svg')->size(150)->generate('Ticket#' . $this->booking->id)
    );

    $pdf = PDF::loadView('tickets.template', [
        'booking' => $this->booking,
        'qrCode' => $qrCode,
    ]);

    return $this->subject('Your Ticket for ' . ($this->booking->event->title ?? 'Event'))
                ->markdown('emails.ticket')
                ->with([
                    'booking' => $this->booking,
                    'qrCode' => $qrCode,
                ])
                ->attachData($pdf->output(), 'ticket_' . $this->booking->id . '.pdf', [
                    'mime' => 'application/pdf',
                ]);
}

}
