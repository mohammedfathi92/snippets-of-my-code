<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;


class News extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = 'news';
    protected $fillable = ['photo', 'in_home', 'status'];

    function scopePublished($query, $scape = 0)
    {
        return $query->where('status', 1)->where("id", "!=", $scape)->orderBy('updated_at', 'desc');
    }

    function scopeInHome()
    {
        return $this->where('status', 1)->where('in_home', 1)->orderBy('updated_at', 'desc');
    }

    function gallery()
    {
        return $this->hasMany("Sirb\Media", 'module_id', 'id')->where('key', 'news-gallery');
    }

       function comments()
    {
        return $this->hasMany(Comment::class, 'module_id', 'id')->where("status", true)->where('module', 'news');
    }

      function reviews()
    {
        return $this->hasMany(Review::class, 'module_id', 'id')->where('module_type', 'news');
    }

}
