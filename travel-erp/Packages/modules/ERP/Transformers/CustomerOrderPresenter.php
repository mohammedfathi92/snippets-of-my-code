<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class CustomerOrderPresenter extends FractalPresenter
{

    /**
     * @return CustomerOrderTransformer
     */
    public function getTransformer()
    {
        return new CustomerOrderTransformer();
    }
}