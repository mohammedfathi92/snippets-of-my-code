<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    protected $table = "contact_messages";
    protected $fillable = ['subject', 'message', 'name', 'email', 'mobile', 'country'];

    function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
