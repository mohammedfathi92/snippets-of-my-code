<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class StudentTip extends Model
{
    use Translatable;

    public $translatedAttributes = ['name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = 'student_tips';
    protected $fillable = ['photo', 'category_id', 'in_home', 'status','show_type'];

    function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    function scopePublished($query, $scape = 0)
    {
        return $query->whereStatus(true)->where("id", "!=", $scape);
    }

   




}
