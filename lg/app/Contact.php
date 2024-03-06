<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table="contacts";

    function sender(){
        return $this->belongsTo("App\User","user_id","id");
    }
}
