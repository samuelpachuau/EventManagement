<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        // Ensure booking relations are loaded
        $this->booking = $booking->loadMissing(['event', 'user']);
    }

    public function build()
    {
        // Defensive checks
        $eventTitle = optional($this->booking->event)->title ?? 'Event';
        $userEmail = optional($this->booking->user)->email;

        // Generate QR Code
        $qrCode = base64_encode(
            QrCode::format('svg')->size(150)->generate('Ticket#' . $this->booking->id)
        );

        // Generate PDF
        $pdf = Pdf::loadView('tickets.template', [
            'booking' => $this->booking,
            'qrCode' => $qrCode,
        ]);

        return $this->subject('Your Ticket for ' . $eventTitle)
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
