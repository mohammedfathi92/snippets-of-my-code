<?php

namespace Modules\Components\CMS;

use Modules\Components\CMS\Facades\CMS;
use \Modules\Components\CMS\Hooks\CMS as CMSHook;
use Modules\Components\CMS\Facades\OpenGraph;
use Modules\Components\CMS\Facades\SEOMeta;
use Modules\Components\CMS\Facades\SEOTools;
use Modules\Components\CMS\Facades\TwitterCard;
use Modules\Components\CMS\Models\Category;
use Modules\Components\CMS\Models\News;
use Modules\Components\CMS\Models\Page;
use Modules\Components\CMS\Models\Post;
use Modules\Components\CMS\Providers\CMSAuthServiceProvider;
use Modules\Components\CMS\Providers\CMSObserverServiceProvider;
use Modules\Components\CMS\Providers\CMSRouteServiceProvider;
use Modules\Components\CMS\Providers\SEOToolsServiceProvider;
use Modules\Components\Utility\Facades\Utility;
use Modules\Settings\Facades\Settings;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class CMSServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'CMS');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'CMS');

        // Load migrations
//        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        //Register Widgets
        $this->registerWidgets();
//        $this->registerCustomFieldsModels();

        \Filters::add_filter('dashboard_content', [CMSHook::class, 'dashboard_content1'], 15);
        \Filters::add_filter('dashboard_content', [CMSHook::class, 'dashboard_content2'], 25);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/cms.php', 'cms');

        $this->app->register(CMSRouteServiceProvider::class);
        $this->app->register(CMSAuthServiceProvider::class);
        $this->app->register(CMSObserverServiceProvider::class);
        $this->app->register(SEOToolsServiceProvider::class);

        //register aliases instead of adding it to config/app.php
        $this->app->booted(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('CMS', CMS::class);
            $loader->alias('SEOMeta', SEOMeta::class);
            $loader->alias('OpenGraph', OpenGraph::class);
            $loader->alias('Twitter', TwitterCard::class);
            $loader->alias('SEO', SEOTools::class);
        });


        Utility::addToUtilityModules('CMS');
    }

    public function registerWidgets()
    {
        \Shortcode::addWidget('cms', \Modules\Components\CMS\Widgets\CMSWidget::class);
        \Shortcode::addWidget('page_views', \Modules\Components\CMS\Widgets\PageViewsWidget::class);
        \Shortcode::addWidget('current_visitors', \Modules\Components\CMS\Widgets\CurrentVisitorCountWidget::class);
    }

    protected function registerCustomFieldsModels()
    {
        Settings::addCustomFieldModel(Post::class);
        Settings::addCustomFieldModel(Page::class);
        Settings::addCustomFieldModel(News::class);
        Settings::addCustomFieldModel(Category::class);
    }
}
