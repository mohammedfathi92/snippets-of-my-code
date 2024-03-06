<?php

namespace App\Mail;

use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewContactUsMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $message;

    /**
     * Create a new message instance.
     * @param Message $message
     *
     */
    public function __construct(Message $message)
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
        return $this->subject(trans("messages.subject_new_message_arrived"))
            ->replyTo($this->message->email, $this->message->name)
            ->view('emails.contact_us.new_notification')->with([
                'client_name'  => $this->message->name,
                'message_body' => $this->message->message_text,
                'data'         => $this->message,
            ]);
    }
}
