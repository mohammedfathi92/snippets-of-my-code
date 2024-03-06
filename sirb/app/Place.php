<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;


class Place extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'description', 'notes', 'meta_keywords', 'meta_description'];
    protected $table = 'places';
    protected $fillable = ['photo', 'in_home', 'in_country', 'map', 'country_id', 'embed_video', 'city_id', 'status'];

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
        return $this->hasMany(Media::class, 'module_id', 'id')->where('key', 'place-gallery');
    }

    function scopePublished($query, $scape = 0)
    {
        return $query->where("status", true)->where("id", "!=", $scape);
    }

    function tabs()
    {
        return $this->hasMany(Tab::class, 'module_id', 'id')->where("key", 'place-tab');
    }

    function scopeInHome()
    {
        return $this->where("in_home", true)->where("status", true);
    }

    function scopeInCountry()
    {
        return $this->published()->where("in_country", true);
    }

       function comments()
    {
        return $this->hasMany(Comment::class, 'module_id', 'id')->where("status", true)->where('module', 'places');
    }

      function reviews()
    {
        return $this->hasMany(Review::class, 'module_id', 'id')->where('module_type', 'places');
    }

}
