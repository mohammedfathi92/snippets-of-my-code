<?php

namespace Corsata;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use Translatable;

    public $translatedAttributes = ['name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = 'categories';
    protected $fillable = ['status','type'];

    function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
    
    function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }


    function scopePublished($query, $scape = 0)
    {
        return $query->whereStatus(true)->where("id", "!=", $scape);
    }

    function articles()
    {
        return $this->hasMany(Article::class);
    }

    function student_tips()
    {
        return $this->hasMany(StudentTip::class,'category_id');
    }


}
