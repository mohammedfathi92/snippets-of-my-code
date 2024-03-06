<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Page extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name', 'content', 'meta_keywords', 'meta_description'];
    protected $fillable = ['slug', 'icon_class', 'photo', 'in_menu', 'status'];
    protected $table = "pages";


    function gallery()
    {
        return $this->hasMany("Sirb\Media", 'module_id', 'id')->where('key', 'page-gallery');
    }

    function tabs()
    {
        return $this->hasMany(Tab::class, 'module_id', 'id')->where("key", 'page-tab');
    }

    function scopePublished($query)
    {
        return $query->whereStatus(true);
    }

}
