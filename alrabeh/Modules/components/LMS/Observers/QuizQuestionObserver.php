<?php

namespace Modules\Components\LMS\Observers;

use Modules\Components\LMS\Models\Question;

class QuizQuestionObserver
{

    /**
     * @param Course $bar
     */
    public function created(Question $bar)
    {
    }
}