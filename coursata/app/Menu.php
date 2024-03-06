<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Corsata\MenuItem;
use Dimsav\Translatable\Translatable;

class Menu extends Model
{
    use Translatable;
    public $translatedAttributes = ['title'];
    protected $table = 'menus';
    protected $fillable = ['show_title', 'position', 'order', 'status'];

    static public function display($position, $type = null, $options = [])
    {
        $instance = new static;

        // GET THE MENU
        $menus = $instance->where('position', '=', $position)->orderBy('order', 'ASC')->get();

        $menu_items = [];
        $output = '';
        if ($menus) {
            foreach ($menus as $menu) {
                if (isset($menu->id)) {
                    // GET THE ROOT MENU ITEMS
                    $menu_items = $menu->firstChildItems()->get(); //MenuItem::where('menu_id', '=', $menu->id)->where('parent_id', 0)->orderBy('order', 'ASC')->get();
                }
                self::buildOutput($menu_items);

            }
        }


        return $output;
    }


    static public function buildOutput($menu_items)
    {
        $outbut = "<ul>";
        if ($menu_items->count()) {
            foreach ($menu_items as $item) {
                $outbut .= "<li> <a>$item->title</a></li>";
            }

        }
        $outbut .= "</ul>";
        return $outbut;
    }

    function firstChildItems()
    {
        return $this->hasMany(MenuItem::class)->where('parent_id', 0)->orderBy('order');
    }

    function items($item_id = 0)
    {
        return $this->hasMany(MenuItem::class)->orderBy('order')->where("id", "!=", $item_id);

    }

   

}
