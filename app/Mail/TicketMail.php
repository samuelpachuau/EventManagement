<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function build()
    {
        // Get related booking, event, and user
        $booking = $this->ticket->booking ?? null;
        $eventTitle = optional($booking->event)->title ?? 'Event';
        $userEmail  = optional($booking->user)->email;

        // Generate QR Code
        $verifyUrl = route('ticket.directVerify', ['ticket_code' => $this->ticket->code]);

        $qrCodeRaw= 
            QrCode::format('svg')->size(150)->generate($verifyUrl);
         $qrCode = base64_encode($qrCodeRaw);
        // Generate PDF
        $pdf = Pdf::loadView('tickets.template', [
            'booking' => $booking,
            'qrCode' => $qrCode,
        ]);

        return $this->subject('Your Ticket for ' . $eventTitle)
                    ->markdown('emails.ticket')
                    ->with([
                        'booking' => $booking,
                        'qrCode'  => $qrCode,
                    ])
                    ->attachData($pdf->output(), $this->ticket->code. '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
