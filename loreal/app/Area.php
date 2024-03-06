<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $primaryKey = "id";
    protected $connection = 'qps';
    protected $table = 'area';

    public function locations()
    {
        return $this->hasMany(Location::class, 'areaid');
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'managerID', 'id');
    }
}
