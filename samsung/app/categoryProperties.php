<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class categoryProperties extends Model
{
    use Translatable;
    protected $primaryKey = "id";
    protected $table = "categories_properties";
    public $translatedAttributes = ['name'];
//    protected $fillable=['property_name','property_icon','property_cat'];
    protected $fillable = ['icon', 'icon_size', 'sort', 'category_id'];

    function category()
    {
        return $this->belongsTo("App\Category", 'id', 'category_id');
    }

    function products()
    {
        return $this->belongsToMany("App\Product", 'products_properties', 'property', 'product')->withPivot('value');
    }
}
