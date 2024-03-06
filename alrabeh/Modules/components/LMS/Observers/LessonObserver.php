<?php

namespace Modules\Components\LMS\Observers;

use Modules\Components\LMS\Models\Lesson;

class LessonObserver
{

    /**
     * @param Course $lesson
     */
    public function created(Lesson $bar)
    {
    }
}