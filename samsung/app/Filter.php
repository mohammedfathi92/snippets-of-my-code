<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
class Filter extends Model
{
    use Translatable;
    protected $table = "categories_filters";
    public $translatedAttributes = ['name'];
    protected $fillable = ['name', 'parent', 'category'];

    function category()
    {
        return $this->belongsTo('App\Category', "category", 'id');
    }

    function parents()
    {
        return $this->belongsTo("App\Filter", 'parent','id');
    }

    function subFilters()
    {
        return $this->hasMany("App\Filter", 'parent','id');
    }

    function products()
    {
        return $this->belongsToMany("App\Product", 'products_filters', 'filter', 'product');
    }
}
