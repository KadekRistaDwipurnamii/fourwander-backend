<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class BookingPaidMail extends Mailable
{
    use Queueable, SerializesModels;

    public Booking $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this
            ->subject('Pembayaran Booking Berhasil - FourWanders Travel')
            ->view('emails.booking_paid')
            ->attach(
                storage_path("app/public/booking_{$this->booking->id}.pdf"),
                [
                    'as' => 'Bukti_Pembayaran_Booking.pdf',
                    'mime' => 'application/pdf',
                ]
            );
    }
}
