<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use \Dimsav\Translatable\Translatable;
    protected $table="categories";
    protected $fillable=['created_by','photo'];
    public $translatedAttributes = ['name','description'];
    use SoftDeletes;

    public function products(){
        return $this->hasMany("App\Product",'category_id');
    }

    public function creator(){
        return $this->belongsTo("App\User");
    }

    protected static function boot() {
        parent::boot();

        static::deleted(function ($category) {
            $category->products()->delete();
        });
    }

}
