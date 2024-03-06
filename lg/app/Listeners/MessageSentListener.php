<?php

namespace App\Listeners;

use App\Events\MessageSent;
use App\Notification;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MessageSentListener
{
    /**
     * Create the event listener.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param  MessageSent $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        $user = Auth::user();

        $language = "en";
        // send notification
        $notification = new Notification();
        $notification->from = $user->id; // 0 means system is the sender
        $notification->message = "notifications.info_new_message_com";
        $notification->model = "contacts";
        $notification->url = "manage/contacts/{$event->message->id}/message";
        $notification->params = serialize(['sender' => $event->message->sender->name]);
        $notification->type = "info";
        $notification->save();
        $admins = User::where("permission", "<", 2)->get();
        $ids = [];
        if ($admins) {
            foreach ($admins as $admin) {
                $ids[] = $admin->id;
                $language=$admin->language;
                Mail::queue("emails.new_message_from_distributor", ["data" => $event->message, "language" => $language,"user_name"=>$admin->name], function ($m) use ($event, $language, $admin) {
                    $m->from(config("settings.app_email"), trans(config("settings.app_title")));
                    $m->to($admin->email, $admin->name)->subject(trans("emails.subject_new_message_com", [], 'messages', $language));
                });
            }
        }

        $notification->users()->sync($ids);

        // send email to user after his opportunity closed


    }
}
