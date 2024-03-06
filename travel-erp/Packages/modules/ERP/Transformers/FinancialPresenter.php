<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class FinancialPresenter extends FractalPresenter
{

    /**
     * @return FinancialTransformer
     */
    public function getTransformer()
    {
        return new FinancialTransformer();
    }
}