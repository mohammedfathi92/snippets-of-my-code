<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class CurrentCustomerPresenter extends FractalPresenter
{

    /**
     * @return CurrentCustomerTransformer
     */
    public function getTransformer()
    {
        return new CurrentCustomerTransformer();
    }
}