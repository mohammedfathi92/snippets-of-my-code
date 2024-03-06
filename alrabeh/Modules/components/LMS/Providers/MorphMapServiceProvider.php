<?php

namespace Modules\Components\LMS\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class MorphMapServiceProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {

        Relation::morphMap([
            'course'   => 'Modules\Components\LMS\Models\Course',
            'lesson'   => 'Modules\Components\LMS\Models\Lesson',
            'section'  => 'Modules\Components\LMS\Models\Section',
            'category' => 'Modules\Components\LMS\Models\Category',
            'question' => 'Modules\Components\LMS\Models\Question',
            'quiz'     => 'Modules\Components\LMS\Models\Quiz',
            'plan'     => 'Modules\Components\LMS\Models\Plan',
            'book'     => 'Modules\Components\LMS\Models\Book',
            
           ]);
    }

}
