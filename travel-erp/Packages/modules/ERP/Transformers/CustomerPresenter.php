<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class CustomerPresenter extends FractalPresenter
{

    /**
     * @return CustomerTransformer
     */
    public function getTransformer()
    {
        return new CustomerTransformer();
    }
}