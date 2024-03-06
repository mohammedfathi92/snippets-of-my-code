<?php

namespace Modules\Components\LMS\Providers;

use Modules\Components\LMS\Models\Category;
use Modules\Components\LMS\Models\News;
use Modules\Components\LMS\Models\Page;
use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\Tag;
use Modules\Components\LMS\Models\Invoice;
use Modules\Components\LMS\Observers\CategoryObserver;
use Modules\Components\LMS\Observers\NewsObserver;
use Modules\Components\LMS\Observers\PageObserver;
use Modules\Components\LMS\Observers\CourseObserver;
use Modules\Components\LMS\Observers\TagObserver;
use Modules\Components\LMS\Observers\InvoiceObserver;
use Illuminate\Support\ServiceProvider;

class LMSObserverServiceProvider extends ServiceProvider
{
    /**
     * Register Observers
     */
    public function boot()
    {
        Course::observe(CourseObserver::class);
        Page::observe(PageObserver::class);
        Category::observe(CategoryObserver::class);
        Tag::observe(TagObserver::class);
        News::observe(NewsObserver::class);
        Invoice::observe(InvoiceObserver::class);
    }
}