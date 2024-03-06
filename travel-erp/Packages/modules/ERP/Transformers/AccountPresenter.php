<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class AccountPresenter extends FractalPresenter
{

    /**
     * @return AccountTransformer
     */
    public function getTransformer()
    {
        return new AccountTransformer();
    }
}