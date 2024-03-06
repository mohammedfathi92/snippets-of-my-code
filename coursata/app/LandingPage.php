<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LandingPage extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name', 'description', 'json_code','lang_status', 'meta_keywords', 'meta_description'];
    protected $fillable = ['slug', 'photo', 'in_menu', 'in_menu', 'status','menu_id'];
    protected $table = "landing_pages";


    function blocks()
    {
        return $this->hasMany(Block::class, 'page_id', 'id');
    }

}
