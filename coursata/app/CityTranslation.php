<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'meta_keywords', 'meta_description'];
    protected $table = "city_translations";
}
