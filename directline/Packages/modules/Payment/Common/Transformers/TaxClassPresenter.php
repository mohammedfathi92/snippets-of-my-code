<?php

namespace Packages\Modules\Payment\Common\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class TaxClassPresenter extends FractalPresenter
{

    /**
     * @return TaxClassTransformer
     */
    public function getTransformer()
    {
        return new TaxClassTransformer();
    }
}