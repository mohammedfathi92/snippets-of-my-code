<?php

namespace Sirb\Mail;

use Sirb\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewBookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $book;

    /**
     * Create a new message instance.
     * @param Booking $booking
     *
     */
    public function __construct(Booking $booking)
    {
        $this->book = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject(trans("bookings.email_subject_booking_type", ['type' => trans("bookings.type_option.{$this->book->booking_type}")]))
            ->replyTo($this->book->email, $this->book->name)
            ->view('emails.booking.new_notification')->with(['data' => $this->book]);
    }
}
