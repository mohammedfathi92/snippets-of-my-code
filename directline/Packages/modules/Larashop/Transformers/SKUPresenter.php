<?php

namespace Packages\Modules\Larashop\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class SKUPresenter extends FractalPresenter
{

    /**
     * @return SKUTransformer
     */
    public function getTransformer()
    {
        return new SKUTransformer();
    }
}