<?php

namespace Modules\Components\LMS\Observers;

use Modules\Components\LMS\Models\Question;

class QuestionObserver
{

    /**
     * @param Course $bar
     */
    public function created(Question $bar)
    {
    }
}