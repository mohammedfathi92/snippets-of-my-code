<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = 'countries';
    protected $fillable = ['code', 'flag','photo','region_id'];

    function cities()
    {
        return $this->hasMany(City::class, 'country_id');
    }

    function states()
    {
        return $this->hasMany(City::class, 'country_id')->where('state_id', '!=', null);
    }

    function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    function shippingProducts()
    {
        return $this->belongsToMany(Product::class, "products_shipping_countries", "country_id", 'product_id')->withPivot("price");
    }

    function institutes()
    {
        return $this->hasMany(Institute::class);
    }

    function bookings()
    {
        return $this->hasMany(Booking::class, 'nationality');
    }

     function bookedHousings()
    {
        return $this->hasMany(BookedHousing::class);
    }

    function users()
    {
        return $this->hasMany(User::class);
    }

    function scopePublished()
    {
        return $this->whereStatus(true);
    }


}
