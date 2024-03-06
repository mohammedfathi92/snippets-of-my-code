<?php

namespace Packages\Modules\Larashop\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class OrderItemPresenter extends FractalPresenter
{

    /**
     * @return OrderItemTransformer
     */
    public function getTransformer()
    {
        return new OrderItemTransformer();
    }
}