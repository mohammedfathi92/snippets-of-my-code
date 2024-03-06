<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['name'];
    protected $table = 'regions';
    protected $fillable = ['status'];

    function countries()
    {
        return $this->hasMany(Country::class);
    }


}
