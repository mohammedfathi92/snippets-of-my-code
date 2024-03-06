<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "bookings";

    function country()
    {
        return $this->belongsTo(Country::class);
    }

    function package()
    {
        return $this->belongsTo(Package::class);
    }

    function room()
    {
        return $this->belongsTo(Room::class);
    }

    function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    function package_type()
    {
        return $this->belongsTo(PackageType::class, "package_type_id", "id");
    }
}
