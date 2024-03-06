<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class City extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = 'cities';
    protected $fillable = ['country_id', 'map', 'status'];

    function gallery()
    {
        return $this->hasMany(Media::class, 'module_id', 'id')->where('key', 'city-gallery');
    }

    function country()
    {
        return $this->belongsTo(Country::class);
    }

    function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    function scopePublished($query, $scape = 0)
    {
        return $query->where("status", true)->where("id", "!=", $scape);
    }

    function scopeInCountry()
    {
        return $this->where("in_country", true);
    }

    function places()
    {
        return $this->hasMany(Place::class);
    }

    function generalCategories()
    {
        return $this->hasMany(Category::class)->where("parent_id", "!=", 0);
    }

    function categories()
    {
        return $this->hasMany(Category::class);
    }

    function tabs()
    {
        return $this->hasMany(Tab::class, 'module_id', 'id')->where("key", 'city-tab');
    }


}
