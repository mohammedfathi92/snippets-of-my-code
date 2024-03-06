<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class HotelService extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];
    protected $table = 'hotel_services';
    protected $fillable = ['icon_class', 'sort'];


    function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_services_hotels', 'service_id', 'hotel_id');
    }
}
