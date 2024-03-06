<?php

namespace Packages\Modules\Larashop\Mails;

use Packages\Modules\Larashop\Models\Order;
use Packages\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderReceivedEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user, $body, $subject, $order;

    /**
     * OrderReceivedEmail constructor.
     * @param User $user
     * @param $order
     * @param null $subject
     * @param null $body
     */
    public function __construct(User $user, Order $order, $subject = null, $body = null)
    {
        $this->user = $user;
        $this->order = $order;
        $this->body = $body;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('Larashop::mails.order_received');
    }
}
