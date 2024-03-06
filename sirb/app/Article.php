<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = 'articles';
    protected $fillable = ['photo', 'category_id', 'in_home', 'status'];

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function scopePublished($query, $scape = 0)
    {
        return $query->whereStatus(true)->where("id", "!=", $scape);
    }

    function tabs()
    {
        return $this->hasMany(Tab::class, 'module_id', 'id')->where("key", 'article-tab');
    }


       function comments()
    {
        return $this->hasMany(Comment::class, 'module_id', 'id')->where("status", true)->where('module', 'articles');
    }

     function reviews()
    {
        return $this->hasMany(Review::class, 'module_id', 'id')->where('module_type', 'articles');
    }


}
