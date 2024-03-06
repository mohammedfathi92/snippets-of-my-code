<?php

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\FractalPresenter;

class CouponGroupPresenter extends FractalPresenter
{

    /**
     * @return CouponGroupTransformer
     */
    public function getTransformer()
    {
        return new CouponGroupTransformer();
    }
}
