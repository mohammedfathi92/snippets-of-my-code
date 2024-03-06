<?php

namespace App\Listeners;

use App\Events\OpportunityProgressUpdated;
use App\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OpportunityProgressUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  OpportunityClosed  $event
     * @return void
     */
    public function handle(OpportunityProgressUpdated $event)
    {
        $user=Auth::user();
        $language=$event->opportunity->user->language;
        // send notification
        $notification=new Notification();
        $notification->from=$user->id; // 0 means system is the sender
        $notification->message="notifications.info_opportunity_progress_updated";
        $notification->model="opportunities";
        $notification->url="opportunities/{$event->opportunity->id}/show";
        $notification->params=serialize(['client_name'=>$event->opportunity->client_name,"user_name"=>$user->name]);
        $notification->type="info";
        $notification->save();
        $notification->users()->sync([$event->opportunity->user_id]);

        // send email to user after his opportunity closed

            Mail::send("emails.user_opportunity_progress_updated",["data"=>$event->opportunity,"language"=>$language],function ($m) use ($event,$language){
                $m->from(config("settings.app_email"),trans(config("settings.app_title")));
                $m->to($event->opportunity->user->email,$event->opportunity->user->name)
                    ->subject(trans("emails.user_opportunity_progress_updated",[],'messages',$language));
            });



    }
}
