<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class OrderPresenter extends FractalPresenter
{

    /**
     * @return OrderTransformer
     */
    public function getTransformer()
    {
        return new OrderTransformer();
    }
}