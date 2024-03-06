<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;

class MenuItemTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];
    protected $table = "menu_item_translations";
}
