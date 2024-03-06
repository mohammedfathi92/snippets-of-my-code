<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class OrderTypePresenter extends FractalPresenter
{

    /**
     * @return OrderTypeTransformer
     */
    public function getTransformer()
    {
        return new OrderTypeTransformer();
    }
}