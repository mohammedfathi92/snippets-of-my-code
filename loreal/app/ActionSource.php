<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionSource extends Model
{
    protected $connection = 'qps';
    protected $table = 'actionsource';
    protected $fillable = ['id', 'SourceName'];
    public $timestamps = false;

    public function getNameAttribute()
    {
        return $this->SourceName;
    }
}
