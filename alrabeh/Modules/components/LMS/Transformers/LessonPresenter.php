<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 11/19/17
 * Time: 8:58 AM
 */

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\FractalPresenter;

class LessonPresenter extends FractalPresenter
{

    /**
     * @return LessonTransformer
     */
    public function getTransformer()
    {
        return new LessonTransformer();
    }
}