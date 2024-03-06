<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;

class TabTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description'];
    protected $table = "tab_translations";
}
