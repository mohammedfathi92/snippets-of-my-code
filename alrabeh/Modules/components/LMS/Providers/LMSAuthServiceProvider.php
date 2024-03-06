<?php

namespace Modules\Components\LMS\Providers;

use Modules\Components\LMS\Models\Category;
use Modules\Components\LMS\Models\Page;
use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\Tag;
use Modules\Components\LMS\Models\News;
use Modules\Components\LMS\Policies\CategoryPolicy;
use Modules\Components\LMS\Policies\PagePolicy;
use Modules\Components\LMS\Policies\CoursePolicy;
use Modules\Components\LMS\Policies\TagPolicy;
use Modules\Components\LMS\Policies\NewsPolicy;
use Modules\Components\LMS\Policies\Invoice;
use Modules\Components\LMS\Policies\InvoicePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class LMSAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Course::class => CoursePolicy::class,
        Page::class => PagePolicy::class,
        Category::class => CategoryPolicy::class,
        Tag::class => TagPolicy::class,
        News::class => NewsPolicy::class,
        Invoice::class => InvoicePolicy::class,
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