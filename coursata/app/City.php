<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;


class City extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = 'cities';
    protected $fillable = ['country_id','state_id','is_state', 'map','photo', 'map_address', 'map_lat', 'map_lng'];

    function country()
    {
        return $this->belongsTo(Country::class);
    }

    function state()
    {
        return $this->belongsTo(self::class, 'state_id', 'id');
    }
    
    function stateCities()
    {
        return $this->hasMany(self::class, 'state_id', 'id');
    }

    function institutes()
    {
        return $this->hasMany(Institute::class);
    }

    function gallery()
    {
        return $this->hasMany(Media::class, 'module_id', 'id')->where('key', 'city-gallery');
    }

   

}
