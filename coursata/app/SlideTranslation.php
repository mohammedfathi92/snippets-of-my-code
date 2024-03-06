<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class SlideTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $table = "slide_translations";
}
