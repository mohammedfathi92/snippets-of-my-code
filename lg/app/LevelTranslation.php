<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelTranslation extends Model
{
    protected $table="level_translations";
    public $timestamps=false;
    protected $fillable = ['name','description'];
}
