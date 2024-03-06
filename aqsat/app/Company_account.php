<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company_account extends Model
{
    protected $fillable = ['account_value','account_number','account_name','user_id','notes',
        'created_by','status','user_name','user_type'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


}
