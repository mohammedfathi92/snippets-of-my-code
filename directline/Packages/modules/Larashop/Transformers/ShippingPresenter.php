<?php

namespace Packages\Modules\Larashop\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class ShippingPresenter extends FractalPresenter
{

    /**
     * @return ShippingTransformer
     */
    public function getTransformer()
    {
        return new ShippingTransformer();
    }
}