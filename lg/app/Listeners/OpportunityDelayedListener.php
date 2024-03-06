<?php

namespace App\Listeners;

use App\Events\OpportunityDelayed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class OpportunityDelayedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OpportunityDelayed  $event
     * @return void
     */
    public function handle(OpportunityDelayed $event)
    {
        $user=Auth::user();
        $days=date_diff($event->opportunity->deliver_at,date("Y-m-d"));
        $language=$event->opportunity->user->language;
        // send notification
        $notification=new Notification();
        $notification->from=0; // 0 means system is the sender
        $notification->message="notifications.warning_opportunity_remaining_days_to_deliver";
        $notification->model="opportunities";
        $notification->url="opportunities/{$event->opportunity->id}/show";
        $notification->params=serialize(['days'=>$days,'client_name'=>$event->opportunity->client_name]);
        $notification->type="info";
        $notification->save();
        $notification->users()->sync([$event->opportunity->user_id]);

        // send email to user after his opportunity closed

        Mail::send("emails.user_opportunity_deliver_before_delay",["data"=>$event->opportunity,"days"=>$days,"language"=>$language],function ($m) use ($event,$language){
            $m->from(config("settings.app_email"),trans(config("settings.app_title")));
            $m->to($event->opportunity->user->email,$event->opportunity->user->name)->subject(trans("emails.user_opportunity_before_delay_subject",[],'messages',$language));
        });



    }
}
