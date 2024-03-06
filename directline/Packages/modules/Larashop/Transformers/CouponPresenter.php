<?php

namespace Packages\Modules\Larashop\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class CouponPresenter extends FractalPresenter
{

    /**
     * @return CouponTransformer
     */
    public function getTransformer()
    {
        return new CouponTransformer();
    }
}