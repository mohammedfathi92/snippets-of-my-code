<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionStatus extends Model
{
    protected $connection = "qps";
    protected $table = "status";
    public $timestamps = false;

    public function getNameAttribute()
    {
        return $this->statusname;
    }
}
