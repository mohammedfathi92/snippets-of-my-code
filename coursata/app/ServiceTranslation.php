<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class ServiceTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'meals', 'transport_type', 'room_type','description'];
    protected $table = "service_translations";
}
