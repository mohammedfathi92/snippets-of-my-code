<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;

class Slide extends Model
{
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $table = 'slides';
    protected $fillable = ['photo', 'sort', 'url', 'status'];

    function scopePublished()
    {
        return $this->where('status', 1);
    }

}
