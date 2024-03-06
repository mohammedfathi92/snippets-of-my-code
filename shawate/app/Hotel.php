<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;

class Hotel extends Model
{
    use Translatable;

    public $translatedAttributes = ['name', 'description', 'notes', 'meta_keywords', 'meta_description'];
    protected $table = 'hotels';
    protected $fillable = ['price', 'photo', 'in_home', 'in_country', 'embed_video', 'address', 'map', 'country_id', 'city_id', 'status'];

    function country()
    {
        return $this->belongsTo(Country::class);
    }

    function city()
    {
        return $this->belongsTo(City::class);
    }


    function tabs()
    {
        return $this->hasMany(Tab::class, 'module_id', 'id')->where("key", 'hotel-tab');
    }

    function rooms()
    {
        return $this->hasMany(Room::class);
    }

    function gallery()
    {
        return $this->hasMany(Media::class, 'module_id', 'id')->where('key', 'hotel-gallery');
    }

    function services()
    {
        return $this->belongsToMany(HotelService::class, 'hotel_services_hotels', 'hotel_id', 'service_id');
    }

    function scopePublished($query, $scape = 0)
    {
        return $query->where("status", true)->where("id", "!=", $scape);
    }

    function scopeInHome()
    {
        return $this->where("in_home", true)->where("status", true);
    }

    function faq()
    {
        return FAQ::whereType("hotels");
    }

    function scopeInCountry()
    {
        return $this->where("status", true)->where("in_country", true);
    }

}
