<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use SoftDeletes;
    protected $table = "message_replies";
    protected $fillable = ['message_text', 'user_id', 'message_id'];

    function message()
    {
        return $this->belongsTo(Message::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
