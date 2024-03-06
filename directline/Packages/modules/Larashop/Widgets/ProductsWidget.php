<?php

namespace Packages\Modules\Larashop\Widgets;

use \Packages\Modules\Larashop\Models\Product;

class ProductsWidget
{

    function __construct()
    {
    }

    function run($args)
    {

        $products = Product::count();
        return ' <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>' . $products . '</h3>
                        <p>'.trans('Larashop::labels.widget.product').'</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-product-hunt"></i>
                    </div>
                    <a href="' . url('e-commerce/products') . '" class="small-box-footer">
                        '.trans('Packages::labels.more_info').'
                    </a>
                </div>';
    }

}