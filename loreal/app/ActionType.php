<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionType extends Model
{
    protected $connection = "qps";
    protected $table = "actiontype";
    public $timestamps = false;
    protected $fillable = ['id', 'TypeName'];

    public function getNameAttribute()
    {
        return $this->TypeName;
    }
}
