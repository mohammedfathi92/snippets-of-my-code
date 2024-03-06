<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];
    protected $table = "menu_translations";
}
