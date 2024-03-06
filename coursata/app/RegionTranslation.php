<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class RegionTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $table = "region_translations";
}
