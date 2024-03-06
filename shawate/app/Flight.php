<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = "packages_flights";

    function fromCountry()
    {
        return $this->belongsTo(Country::class, 'from_country_id', 'id');
    }

    function toCountry()
    {
        return $this->belongsTo(Country::class, 'to_country_id', 'id');
    }

    function fromCity()
    {
        return $this->belongsTo(City::class, 'from_city_id', 'id');
    }

    function toCity()
    {
        return $this->belongsTo(City::class, 'to_city_id', 'id');
    }

    function flight()
    {
        return $this->belongsTo(Transport::class, 'flight_id', 'id');
    }

    function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

}
