<?php

namespace Packages\Modules\Larashop\Widgets;

use \Packages\Modules\Larashop\Models\Order;

class MyPrivatePagesWidget
{

    function __construct()
    {
    }

    function run($args)
    {

        $orders = user()->posts->count();
        return ' <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>' . $orders . '</h3>
                        <p>'.trans('Larashop::labels.widget.private_page').'</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file"></i>
                    </div>
                    <a href="' . url('e-commerce/private-pages/my') . '" class="small-box-footer">
                         '.trans('Packages::labels.more_info').'
                    </a>
                </div>';
    }

}