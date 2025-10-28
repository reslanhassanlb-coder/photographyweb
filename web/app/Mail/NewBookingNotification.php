<?php

namespace App\Mail;

use App\Models\PackageBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewBookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The booking instance.
     *
     * @var \App\Models\PackageBooking
     */
    public $booking;

    /**
     * Create a new message instance.
     */
    public function __construct(PackageBooking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        return new Envelope(
            subject: 'New Package Booking Received! 🎉',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.bookings.notification', // Create this Blade view next
            // Pass the booking data to the view
            with: [
                'booking' => $this->booking,
            ],
        );
    }
}
