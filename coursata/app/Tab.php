<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;


class Tab extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['title', 'description'];
    protected $table = 'tabs';
    protected $fillable = ['photo', 'sort','module_id','key'];

}
