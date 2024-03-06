<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;


class Package extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'description', 'notes', 'meta_keywords', 'meta_description'];
    protected $table = 'packages';
    protected $fillable = ['price', 'photo', 'in_home', 'country_id', 'status'];

    function country()
    {
        return $this->belongsTo("Sirb\Country");
    }

    function type()
    {
        return $this->belongsTo(PackageType::class, "type_id", "id");
    }

    function faq()
    {
        return FAQ::whereType("packages");
    }

    function scopeInHome()
    {
        return $this->where('status', 1)->where('in_home', 1);
    }

    function scopePublished($query, $scape = 0)
    {
        return $query->where('status', 1)->where("id", "!=", $scape);
    }

    function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'packages_cities_hotels_rooms', 'package_id', 'hotel_id')->withPivot(['city_id', 'room_id','rooms_count' ,'days','order']);
    }

    function rooms()
    {
        return $this->belongsToMany(Room::class, 'packages_cities_hotels_rooms', 'package_id', 'room_id')->withPivot(['city_id', 'hotel_id','rooms_count', 'days', 'order'])->orderBy('order', 'asc');
    }

    function flights()
    {
        return $this->belongsToMany(Transport::class, 'packages_flights', 'package_id', 'flight_id')->withPivot(['from_country_id', 'from_city_id', 'to_country_id', 'to_city_id', 'order'])->orderBy('order', 'asc');
    }

    function transports()
    {
        return $this->belongsToMany(Transport::class, 'packages_transports', 'package_id', 'transport_id')->withPivot(['city_id', 'order'])->orderBy('order', 'asc');
    }

    function gallery()
    {
        return $this->hasMany("Sirb\Media", 'module_id', 'id')->where('key', 'package-gallery');
    }

    function scopeInCountry()
    {
        return $this->published()->where("in_country", true);
    }


       function comments()
    {
        return $this->hasMany(Comment::class, 'module_id', 'id')->where("status", true)->where('module', 'packages');
    }

      function reviews()
    {
        return $this->hasMany(Review::class, 'module_id', 'id')->where('module_type', 'packages');
    }

}
