<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Transport extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'company_name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = 'transports';
    protected $fillable = ['price', 'photo', 'type', 'in_home', 'address', 'country_id', 'city_id', 'status'];

    function country()
    {
        return $this->belongsTo("App\Country");
    }

    function city()
    {
        return $this->belongsTo("App\City");
    }

    function gallery()
    {
        return $this->hasMany("App\Media", 'module_id', 'id')->where('key', 'transport-gallery');
    }

    function scopePublished()
    {
        return $this->where("status", true);
    }

    function scopeInHome()
    {
        return $this->where("in_home", true)->where("status", true);
    }

}
