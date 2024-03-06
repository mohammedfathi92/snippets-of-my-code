<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable =
        ['full_name','formal_name','national_id','release_date','release_place','mobile','phone','address','work',
        'work_phone','nationality','user_id','gender','notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
