<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class ExpensePresenter extends FractalPresenter
{

    /**
     * @return ExpenseTransformer
     */
    public function getTransformer()
    {
        return new ExpenseTransformer();
    }
}