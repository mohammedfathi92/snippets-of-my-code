<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;
use App\updateOut;

class Product extends Model
{
    use Translatable;
    protected $table = 'products';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $translatedAttributes = ['name', 'description', 'slide_description'];
    protected $fillable = [

        'photo',
        'category',
        'show_in_home',
        'slide_photo',
        'slide_background'

    ];

    function category()
    {
        return $this->belongsTo("App\Category", 'category', 'id');
    }

    function properties()
    {
        return $this->belongsToMany("App\categoryProperties", 'products_properties', 'product', 'property')->withPivot('value');
    }

    function gallery()
    {
        return $this->hasMany("App\productGallery");
    }

    function filters()
    {
        return $this->belongsToMany("App\Filter", 'products_filters', 'product', 'filter');
    }

    function colors()
    {
        return $this->hasMany("App\productColors");
    }


}
