<?php

namespace Modules\Components\CMS\Providers;

use Modules\Components\CMS\Models\Category;
use Modules\Components\CMS\Models\News;
use Modules\Components\CMS\Models\Page;
use Modules\Components\CMS\Models\Post;
use Modules\Components\CMS\Observers\CategoryObserver;
use Modules\Components\CMS\Observers\NewsObserver;
use Modules\Components\CMS\Observers\PageObserver;
use Modules\Components\CMS\Observers\PostObserver;
use Illuminate\Support\ServiceProvider;

class CMSObserverServiceProvider extends ServiceProvider
{
    /**
     * Register Observers
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
        Page::observe(PageObserver::class);
        Category::observe(CategoryObserver::class);
        News::observe(NewsObserver::class);
    }
}
