<?php

namespace Corsata\Mail;

use Corsata\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUsReply extends Mailable
{
    use Queueable, SerializesModels;

    protected $reply;

    /**
     * Create a new message instance.
     * @param Reply $reply
     *
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.contact_us.reply')->with([
            'client_name'  => $this->reply->message->name,
            'message_body' => $this->reply->message_text,
        ]);
    }
}
