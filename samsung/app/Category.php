<?php

namespace App;

use Dimsav\Translatable\Translatable;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use Translatable;

    protected $primaryKey = "id";
    protected $table = "categories";
    public $translatedAttributes = ['cat_title', 'cat_description'];
    protected $fillable = [
        'cat_slug'
    ];

//    Soft Deletes in is not Active
//    use SoftDeletes;
//    protected $dates = ['deleted_at'];

    function products()
    {
        return $this->hasMany("App\Product", 'category', 'id');
    }

    function properties()
    {
        return $this->hasMany("App\categoryProperties", 'category_id', 'id');
    }

    function filters()
    {
        return $this->hasMany("App\Filter", 'category', 'id');
    }
}
