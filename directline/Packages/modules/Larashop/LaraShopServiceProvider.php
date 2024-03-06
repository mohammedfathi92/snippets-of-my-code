<?php

namespace Packages\Modules\Larashop;


use Packages\Foundation\Search\IndexedRecord;
use Packages\Modules\Larashop\Facades\OrderManager;
use Packages\Modules\Larashop\Facades\Shipping;
use Packages\Modules\Larashop\Facades\Shop;
use Packages\Modules\Larashop\Facades\ShoppingCart;
use Packages\Modules\Larashop\Facades\Wishlist;
use Packages\Modules\Larashop\Facades\Larashop as LarashopFacade;
use Packages\Modules\Larashop\Classes\ShoppingCart as ShoppingCartClass;
use Packages\Modules\Larashop\Hooks\Larashop;

use Packages\Modules\Larashop\Models\Product;
use Packages\Modules\Larashop\Models\SKU;
use Packages\Modules\Larashop\Notifications\OrderReceivedNotification;
use Packages\Modules\Larashop\Providers\LarashopAuthServiceProvider;
use Packages\Modules\Larashop\Providers\LarashopObserverServiceProvider;
use Packages\Modules\Larashop\Providers\LarashopRouteServiceProvider;
use Packages\User\Communication\Facades\PackagesNotification;
use Packages\Settings\Facades\Settings;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class LarashopServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Load view
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'Larashop');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'Larashop');

        // Load migrations
        //$this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->registerHooks();
        $this->registerWidgets();
        $this->addEvents();
        $this->registerCustomFieldsModels();

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/ecommerce.php', 'ecommerce');

        $this->app->register(LarashopRouteServiceProvider::class);
        $this->app->register(LarashopAuthServiceProvider::class);
        $this->app->register(LarashopObserverServiceProvider::class);


        $this->app->singleton(ShoppingCartClass::SERVICE, function ($app) {
            return new ShoppingCartClass($app['session'], $app['events'], $app['auth']);
        });

        //register alias instead of adding it to config/app.php
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('ShoppingCart', ShoppingCart::class);
            $loader->alias('Larashop', LarashopFacade::class);
            $loader->alias('OrderManager', OrderManager::class);
            $loader->alias('Shop', Shop::class);
            $loader->alias('Shipping', Shipping::class);
            $loader->alias('Wishlist', Wishlist::class);

        });


    }

    public function registerHooks()
    {
        \Actions::add_action('show_navbar', [Larashop::class, 'show_cart_icon'], 11);
        \Actions::add_action('user_profile_tabs', [Larashop::class, 'show_profile_tabs_items'], 11);
        \Actions::add_action('user_profile_tabs_content', [Larashop::class, 'show_profile_tabs_content'], 11);
        \Filters::add_filter('dashboard_content', [Larashop::class, 'dashboard_content'], 8);

    }

    public function registerWidgets()
    {
        \Shortcode::addWidget('orders', \Packages\Modules\Larashop\Widgets\OrdersWidget::class);
        \Shortcode::addWidget('products', \Packages\Modules\Larashop\Widgets\ProductsWidget::class);
        \Shortcode::addWidget('coupons', \Packages\Modules\Larashop\Widgets\CouponsWidget::class);
        \Shortcode::addWidget('product_categories', \Packages\Modules\Larashop\Widgets\ProductCategoriesWidget::class);
        \Shortcode::addWidget('brand_ratio', \Packages\Modules\Larashop\Widgets\BrandRatioWidget::class);

        \Shortcode::addWidget('my_orders', \Packages\Modules\Larashop\Widgets\MyOrdersWidget::class);
        \Shortcode::addWidget('my_wishlist', \Packages\Modules\Larashop\Widgets\MyWishlistWidget::class);
        \Shortcode::addWidget('my_downloads', \Packages\Modules\Larashop\Widgets\MyDownloadsWidget::class);
        \Shortcode::addWidget('my_private_pages', \Packages\Modules\Larashop\Widgets\MyPrivatePagesWidget::class);



    }

    protected function registerCustomFieldsModels()
    {
        Settings::addCustomFieldModel(Product::class, 'Product (Larashop)');
        Settings::addCustomFieldModel(SKU::class);
    }

    protected function addEvents()
    {
        PackagesNotification::addEvent(
            'notifications.e_commerce.order.received',
            'Larashop Order Received',
            OrderReceivedNotification::class);
    }
}
