<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Overtrue\LaravelFollow\Traits\CanBeFavorited;

class Institute extends Model
{
    use Translatable;
    use CanBeFavorited;

    public $translatedAttributes = ['name', 'description', 'address', 'bank_account', 'meta_keywords', 'meta_description'];
    protected $table = 'institutes';
    protected $fillable = ['photo', 'video_youtube', 'address', 'email', 'website', 'phone', 'location_type',
        'country_id', 'city_id', 'locale_rate', 'international_rate', 'in_home', 'featured', 'status', 'map_address', 'map_lat', 'map_lng'];

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
        return $this->hasMany(Tab::class, 'module_id', 'id')->where("key", 'institute-tab');
    }

    function courses($scape = 0)
    {
        return $this->hasMany(Course::class)->where("id", "!=", $scape);
    }

    /* function currency()
     {
         return $this->belongsTo(Currency::class);
     }*/

    function gallery()
    {
        return $this->hasMany(Media::class, 'module_id', 'id')->where('key', 'institute-gallery');
    }

    function services()
    {
        return $this->hasMany(Service::class);
    }

    function scopePublished($query, $scape = 0)
    {
        return $query->where("status", true)->where("id", "!=", $scape);
    }

    function scopeInHome()
    {
        return $this->where("in_home", true)->where("status", true);
    }


    function housingServices()
    {
        return $this->hasMany(Service::class)->where("type", 'house');
    }

    function transportingServices()
    {
        return $this->hasMany(Service::class)->where("type", 'transport');
    }

    function insuranceServices()
    {
        return $this->hasMany(Service::class)->where("services.type", 'insurance');
    }

    function adviserServices()
    {
        return $this->hasMany(Service::class)->where("type", 'adviser');
    }
    
    function favoriteUsers()
    {
       return $this->belongsToMany(User::class, 'wishlist_user', 'institute_id', 'user_id');

    }

     function bookings()
    {
        return $this->hasMany(Booking::class, "institute_id");
    }

}
