<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 9:58 AM
 */

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\FractalPresenter;

class QuizPresenter extends FractalPresenter
{

    /**
     * @return QuizTransformer
     */
    public function getTransformer()
    {
        return new QuizTransformer();
    }
}