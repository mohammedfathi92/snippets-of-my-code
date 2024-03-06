<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;


class CompareAttr extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];
    protected $table = 'compare_attrs';
    protected $fillable = ['slug','type','order','status'];

}
