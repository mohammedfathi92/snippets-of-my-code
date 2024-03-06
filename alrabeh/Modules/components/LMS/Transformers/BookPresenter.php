<?php

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\FractalPresenter;

class BookPresenter extends FractalPresenter
{

    /**
     * @return BookTransformer
     */
    public function getTransformer()
    {
        return new BookTransformer();
    }
}