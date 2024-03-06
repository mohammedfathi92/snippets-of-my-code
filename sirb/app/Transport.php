<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;


class Transport extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'company_name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = 'transports';
    protected $fillable = ['price', 'photo', 'type', 'in_home', 'address', 'country_id', 'city_id', 'status'];

    function country()
    {
        return $this->belongsTo("Sirb\Country");
    }

    function city()
    {
        return $this->belongsTo("Sirb\City");
    }

    function gallery()
    {
        return $this->hasMany("Sirb\Media", 'module_id', 'id')->where('key', 'transport-gallery');
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
