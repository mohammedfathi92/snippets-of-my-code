<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoryPropertiesTranslation extends Model
{


    public $timestamps = false;
    protected $table='categories_properties_translations';
    protected $primaryKey='id';
    protected $fillable = ['name'];
}
