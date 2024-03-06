<?php

namespace Corsata;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BasicService extends Model
{
    use Translatable;
    use SoftDeletes;
    public $translatedAttributes = ['name', 'meals', 'transport_type', 'room_type','description'];
    protected $table = 'basic_services';
    protected $fillable = ['photo', 'sort', 'price', 'min_age', 'type'];


}
