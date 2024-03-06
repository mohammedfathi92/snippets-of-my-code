<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomServiceTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $table = "room_service_translations";
}
