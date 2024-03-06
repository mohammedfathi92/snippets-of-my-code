<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{

    use SoftDeletes;
    public $timestamps = true;
    protected $table = "notifications";
    protected $fillable = ['from', 'message', 'type', 'dismissed', 'params', 'icon'];

    function from()
    {
        return $this->belongsTo("App\User", "from", "id");
    }

    function users()
    {
        return $this->belongsToMany("App\User", "users_notifications", "notification_id", "user_id");
    }

    
}
