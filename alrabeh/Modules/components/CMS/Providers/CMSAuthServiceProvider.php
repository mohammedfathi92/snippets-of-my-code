<?php

namespace Modules\Components\CMS\Providers;

use Modules\Components\CMS\Models\Category;
use Modules\Components\CMS\Models\Page;
use Modules\Components\CMS\Models\Post;
use Modules\Components\CMS\Models\News;
use Modules\Components\CMS\Policies\CategoryPolicy;
use Modules\Components\CMS\Policies\PagePolicy;
use Modules\Components\CMS\Policies\PostPolicy;
use Modules\Components\CMS\Policies\NewsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class CMSAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Page::class => PagePolicy::class,
        Category::class => CategoryPolicy::class,
        News::class => NewsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
