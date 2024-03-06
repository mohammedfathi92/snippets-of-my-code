<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PackageType extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'description', 'notes', 'meta_keywords', 'meta_description'];
    protected $table = 'package_types';
    protected $fillable = ['country_id', 'status'];

    function country()
    {
        return $this->belongsTo("App\Country");
    }

    function packages()
    {
        return $this->hasMany("App\Package", 'type_id', 'id');
    }

    function scopePublished($query, $scape = 0)
    {
        $query->where("status", true)->where("id", "!=", $scape);
    }

}
