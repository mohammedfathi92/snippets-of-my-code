<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use \Dimsav\Translatable\Translatable;
    protected $table="about";
    protected $fillable=['updated_by'];
    public $translatedAttributes = ['title','body'];
}
