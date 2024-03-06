<?php

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\FractalPresenter;

class CoursePresenter extends FractalPresenter
{

    /**
     * @return CourseTransformer
     */
    public function getTransformer()
    {
        return new CourseTransformer();
    }
}