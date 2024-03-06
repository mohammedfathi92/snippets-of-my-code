<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = 'categories';
    protected $fillable = ['photo', 'parent_id', 'in_home', 'country_id', 'city_id', 'status'];

    function country()
    {
        return $this->belongsTo(Country::class);
    }

    function scopePublished($query, $scape = 0)
    {
        return $query->whereStatus(true)->where("id", "!=", $scape);
    }

    function city()
    {
        return $this->belongsTo(City::class, "city_id", "id");
    }

    function articles()
    {
        return $this->hasMany(Article::class);
    }

    function subCategories()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }


}
