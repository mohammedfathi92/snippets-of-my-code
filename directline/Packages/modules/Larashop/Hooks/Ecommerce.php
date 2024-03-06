<?php

namespace Packages\Modules\Larashop\Hooks;


use Packages\Modules\Larashop\DataTables\MyOrdersDataTable;

class Larashop
{
    /**
     * Subscription constructor.
     */
    function __construct()
    {
    }

    public function show_cart_icon()
    {
        if (user()->hasPermissionTo('Larashop::cart.access')) {
            echo '<li class="cart cart-menu" >
                        <a href = "' . url('e-commerce/cart') . '" style = "padding: 10px 15px;" >
                            <i class="fa fa-2x fa-shopping-cart" style = "" ></i >
                            <span class="label label-success"
                                  style = "cart_total_label"
                                  id = "cart-header-total" >' . \ShoppingCart::total() . '</span >
                        </a >
                    </li >';
        }
    }

    /**
     * @param $user
     * @param $active_tab
     * @throws \Throwable
     */
    public function show_profile_tabs_items($user, $active_tab)
    {
        if ($user->hasPermissionTo('Larashop::orders.access')) {
            $profile_subscription_tabs = view('Larashop::shop.partials.tabs_items')->with(compact('user', 'active_tab'))->render();
            echo $profile_subscription_tabs;
        }
    }

    public function show_profile_tabs_content($user, $active_tab)
    {


        if ($user->hasPermissionTo('Larashop::orders.access')) {
            $dataTable = new MyOrdersDataTable();
            $dataTable->setResourceUrl(url('e-commerce/orders/my'));

            $profile_ecommerce_tabs = $dataTable->render('Larashop::shop.partials.tabs_content', compact('user', 'active_tab'))->render();
            echo $profile_ecommerce_tabs;
            echo $dataTable->html()->assets();
            \Actions::add_action('admin_footer_js', function () use ($dataTable) {
                $filter_script = view('layouts.crud.filters_script')->render();
                echo $filter_script;
                echo $dataTable->html()->scripts();
            }, 11);

        }

    }

    /**
     * @param $dashboard_content
     * @return string
     * @throws \Throwable
     */
    public function dashboard_content($dashboard_content, $active_tab)
    {
        if (user()->hasRole('superuser')) {
            $dashboard_content .= view('Larashop::dashboard.superuser')->with(compact('active_tab'))->render();
        }else{
            $dashboard_content .= view('Larashop::dashboard.user')->with(compact('active_tab'))->render();

        }


        return $dashboard_content;
    }
}

