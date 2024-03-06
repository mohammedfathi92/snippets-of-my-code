<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookedHousing extends Model
{

	use \Dimsav\Translatable\Translatable;


	public $translatedAttributes = ['name', 'description'];

	protected $table = "booked_housings";
	protected $fillable = ['photo',  'address_line1', 'address_line2', 'country_id', 'map','type', 'city_id', 'status','state'];


     function bookings()
    {
        return $this->hasMany(Booking::class, "housing_id");
    }

     function country()
    {
        return $this->belongsTo(Country::class);
    }

    function city()
    {
        return $this->belongsTo(City::class);
    }

     function gallery()
    {
        return $this->hasMany(Media::class, 'module_id', 'id')->where('key', 'housing-gallery');
    }
    
}
