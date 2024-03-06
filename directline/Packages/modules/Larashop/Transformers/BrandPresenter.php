<?php

namespace Packages\Modules\Larashop\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class BrandPresenter extends FractalPresenter
{

    /**
     * @return BrandTransformer
     */
    public function getTransformer()
    {
        return new BrandTransformer();
    }
}