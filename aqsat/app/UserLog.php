<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = 'users_logs';

    protected $fillable =
        ['user_id','action','module','module_id','notes','attrs'];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
