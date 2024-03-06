<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class BasicServiceTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'meals', 'transport_type', 'room_type','description'];
    protected $table = "basic_service_translations";
}
