<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilterTranslation extends Model
{
    public $timestamps = false;

    protected $table='categories_filters_translations';
    protected $primaryKey='id';
    protected $fillable = ['name'];

}
