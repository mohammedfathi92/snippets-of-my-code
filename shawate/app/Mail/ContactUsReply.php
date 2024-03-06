<?php

namespace App\Mail;

use App\Reply;
use App\Setting;
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

        $reply_receivers = explode(PHP_EOL, Setting::get("receivers_emails"));

        $emails = array_map('trim', $reply_receivers);

        return $this->subject(trans("messages.reply_prefix") . $this->reply->message->subject)
            ->replyTo($emails)
            ->view('emails.contact_us.reply')->with([
                'data' => $this->reply,
            ]);
    }
}
