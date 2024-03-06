<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $connection = "qps";
    protected $primaryKey = "id";
    protected $table = "location";

    public function area()
    {
        return $this->belongsTo(Area::class, "areaID");
    }
}
