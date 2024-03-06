<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    protected $fillable = ['note','module_id','module','created_by'];


    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

}
