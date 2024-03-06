<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class YearPresenter extends FractalPresenter
{

    /**
     * @return YearTransformer
     */
    public function getTransformer()
    {
        return new YearTransformer();
    }
}