<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;

class Country extends Model
{
    use Translatable;

    public $translatedAttributes = ['name', 'description', 'guide', 'notes', 'meta_keywords', 'meta_description'];
    protected $table = 'countries';
    protected $fillable = ['flag', 'status'];

    function cities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }

    function photo()
    {
        return $this->gallery()->first();
    }

    function gallery()
    {
        return $this->hasMany("App\Media", 'module_id', 'id')->where('key', 'country-gallery');
    }

    function scopePublished()
    {
        return $this->whereStatus(true);
    }

    function scopePublishedAtHome()
    {
        return $this->where('status', true)->get();
    }


    function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    function places()
    {
        return $this->hasMany(Place::class);
    }

    function package_types()
    {
        return $this->hasMany(PackageType::class);
    }

    function packages()
    {
        return $this->hasMany(Package::class);
    }

    function faq()
    {
        return FAQ::whereType("countries");
    }

    function categories()
    {
        return $this->hasMany(Category::class);
    }

    function generalCategories()
    {
        return $this->hasMany(Category::class)->where("city_id", null);
    }

    function tabs()
    {
        return $this->hasMany(Tab::class, 'module_id', 'id')->where("key", 'country-tab');
    }

    function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }


}
