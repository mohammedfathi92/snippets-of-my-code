<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 6:50 AM
 */

/**
 * Display menu items in menu management
 * @param $item
 * @param $menu
 * @param string $locale
 * @param string $backend_uri
 */
function generateSubMenuItemsRows($item, $menu, $locale = "", $backend_uri = "")
{

    $prefix = "->";
    if ($item->subItems()->count()):
        foreach ($item->subItems as $sr):
            ?>

            <tr>
                <td><?php echo $sr->id ?></td>
                <td><a href="<?php echo $sr->url ?>"><?php echo $prefix . " " . $sr->title ?></a></td>
                <td><?php echo $sr->url ?></td>
                <td><?php echo $sr->position ?></td>
                <td><?php echo $sr->order ?></td>
                <td><?php echo $sr->status ? '<span class="label label-success">' . trans("menus.status_active") . '</span>' : '<span
                            class="label label-danger">' . trans("menus.status_inactive") . '</span>' ?>
                </td>
                <td><?php echo \Carbon\Carbon::instance($sr->updated_at)->diffForHumans() ?></td>
                <td class="text-right">
                    <?php if (Auth::user()->can('edit menus')): ?>
                        <a href="<?php echo url("$locale/$backend_uri/menus/{$menu->id}/items/$sr->id/edit") ?>"
                           class="btn btn-default btn-xs" data-toggle="tooltip"
                           data-placement="top"
                           title="<?php echo trans("main.tooltip_edit") ?>"><i
                                    class="fa fa-pencil"></i></a>
                    <?php endif; ?>
                    <?php if (Auth::user()->can('delete menus')): ?>
                        <a href="<?php echo url("$locale/$backend_uri/menus/{$menu->id}/items/$sr->id/delete") ?>"
                           class="btn btn-danger btn-xs" data-toggle="tooltip"
                           data-placement="top"
                           title="<?php echo trans("main.tooltip_delete") ?>"
                           onclick="return confirm('<?php echo trans("main.alert_delete_confirmation") ?>')"><i
                                    class="fa fa-times"></i></a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php /*$prefix .= "->";*/ ?>
            <?php generateSubMenuItemsRows($sr, $menu, $locale, $backend_uri); ?>

        <?php endforeach; ?>
    <?php endif; ?>
    <?php
}

/**
 * Frontend menus
 * @param string $position
 * @param Array $options set custom ('class': for main ul class, 'sub_menu_class' : custom class for child ul, title_class: custom h2 class)
 * @return null|string
 */
function menu($position = 'main_menu', $options = [])
{
    $menus = \App\Menu::where('position', $position)->orderBy('order', "ASC");
    $class = isset($options['class']) ? $options['class'] : null;
    $title_class = isset($options['title_class']) ? $options['title_class'] : null;
    $block_class = isset($options['block_class']) ? $options['block_class'] : null;
    $output = "";
    if ($menus->count()) {

        foreach ($menus->get() as $menu) {
            $output .= "<div class='$block_class'>";
            if ($menu->show_title)
                $output .= "<h2 class='{$title_class}'>$menu->title</h2>";
            $output .= "<ul class='{$menu->css_class} {$class}'>";
            $menu_items = $menu->firstChildItems()->whereStatus(true)->get();
            if ($menu_items->count())
                $output .= buildMenuItems($menu_items, $options);
            $output .= "</ul></div>";
        }


    }

    return $output;
}

/**
 * Frontend menu items
 * @param $menu_items
 * @return string
 */
function buildMenuItems($menu_items, $options = [])
{
    $first = true;

    $output = "";

    foreach ($menu_items as $item) {

        $output .= "<li class='$item->css_class " . ($item->subItems()->published()->count() ? "menu-item-has-children" : "") . "'><a href='$item->url'>$item->title</a>";
        $sub_menu_class = isset($options['sub_menu_class']) ? $options['sub_menu_class'] : null;
        $sub_items = $item->subItems()->where("status",true)->get();
        if ($sub_items->count()) {
            $output .= "<ul class='{$sub_menu_class}'>";
            $output .= buildMenuItems($sub_items);
            $output .= "</ul>";
        }

        $output .= "</li>";

    }


    return $output;

}