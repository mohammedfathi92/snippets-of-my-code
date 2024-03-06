<?php

namespace Sirb\Mail;

use Sirb\Message;
use Sirb\Testimonial;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewTestimonialMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $message;

    /**
     * Create a new message instance.
     * @param Message $message
     *
     */
    public function __construct(Testimonial $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans("testimonials.subject_new_message_arrived"))
            ->replyTo($this->message->email, $this->message->name)
            ->view('emails.testimonials.new_notification')->with([
                'data'         => $this->message,
            ]);
    }
}
