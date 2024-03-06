<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class RoomService extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];
    protected $table = 'room_services';
    protected $fillable = ['icon_class', 'sort'];

    function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_services_rooms', 'service_id', 'room_id');
    }

}
