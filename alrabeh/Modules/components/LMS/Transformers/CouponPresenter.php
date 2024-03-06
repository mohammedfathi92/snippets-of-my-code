<?php

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\FractalPresenter;

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
