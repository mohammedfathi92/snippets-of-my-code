<?php

namespace Packages\Modules\Larashop\Widgets;

use \Packages\Modules\Larashop\Models\Category;

class ProductCategoriesWidget
{

    function __construct()
    {
    }

    function run($args)
    {

        $categories = Category::count();
        return ' <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>' . $categories . '</h3>
                        <p>'.trans('Larashop::labels.widget.product_categories').'</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-folder-open fa-fw"></i>
                    </div>
                    <a href="' . url('e-commerce/categories') . '" class="small-box-footer">
                        '.trans('Packages::labels.more_info').'
                    </a>
                </div>';
    }

}