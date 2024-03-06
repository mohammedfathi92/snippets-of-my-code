<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LandingPage extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name', 'description', 'lang_status', 'meta_keywords', 'meta_description'];
    protected $fillable = ['slug', 'photo', 'menu_id', 'in_menu', 'status', 'page_color'];
    protected $table = "landing_pages";


    function blocks()
    {
        return $this->hasMany(LandingBlock::class, 'page_id', 'id');
    }

}
