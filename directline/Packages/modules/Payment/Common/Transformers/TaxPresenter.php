<?php

namespace Packages\Modules\Payment\Common\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class TaxPresenter extends FractalPresenter
{

    /**
     * @return TaxTransformer
     */
    public function getTransformer()
    {
        return new TaxTransformer();
    }
}