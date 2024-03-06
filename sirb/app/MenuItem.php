<?php

namespace Sirb;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class MenuItem extends Model
{
    use Translatable;
    public $translatedAttributes = ['title'];
    protected $table = 'menu_items';
    protected $fillable = ['menu_id', 'url', 'target', 'icon_class', 'parent_id', 'color', 'order', 'status'];

    function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    function scopePublished($query)
    {
        return $query->whereStatus(true);
    }


    function subItems()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->orderBy('order');
    }
}
