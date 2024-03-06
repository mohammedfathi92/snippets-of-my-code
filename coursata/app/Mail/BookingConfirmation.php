<?php

namespace Corsata\Mail;

use Corsata\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    protected $book;

    /**
     * Create a new message instance.
     * @param Reply $reply
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

        return $this->view('emails.booking.confirmation')->with(['data' => $this->book]);
    }
}
