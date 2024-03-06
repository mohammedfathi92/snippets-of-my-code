<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Room extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'description', 'notes', 'meta_keywords', 'meta_description'];
    protected $table = 'rooms';
    protected $fillable = ['price', 'photo', 'in_home', 'featured', 'embed_video', 'address', 'map', 'country_id', 'city_id', 'status'];

    function hotel()
    {
        return $this->belongsTo("App\Hotel");
    }

    function gallery()
    {
        return $this->hasMany("App\Media", 'module_id', 'id')->where('key', 'room-gallery');
    }

    function city()
    {
        return $this->hotel->city();
    }

    function services()
    {
        return $this->belongsToMany(RoomService::class, 'room_services_rooms', 'room_id', 'service_id');
    }

    function scopePublished()
    {
        return $this->where('status', true);
    }

}
