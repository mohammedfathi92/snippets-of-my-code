<?php

namespace Packages\Modules\Larashop\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class ProductPresenter extends FractalPresenter
{

    /**
     * @return ProductTransformer
     */
    public function getTransformer()
    {
        return new ProductTransformer();
    }
}