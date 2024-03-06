<?php

namespace App\Listeners;

use App\Events\UserLogs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\UserLog;
use App\User;

class UserLogsFired
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
     * @param  UserLogs  $event
     * @return void
     */
    public function handle(UserLogs $event)
    {     
        $params = $event->params;
        UserLog::create([
            'user_id'=>Auth::id(),
            'action'=>array_key_exists('action', $params)?$params['action']:null,
            'notes'=>array_key_exists('notes', $params)?$params['notes']:null,
            'module'=>array_key_exists('module', $params)?$params['module']:null,
            'module_id'=>array_key_exists('module_id', $params)?$params['module_id']:null,
            'attrs'=>array_key_exists('attrs', $params)?json_encode($params['attrs']):null,
        ]); 

    }
}
