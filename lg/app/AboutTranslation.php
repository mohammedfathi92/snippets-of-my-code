<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title','body'];
}
