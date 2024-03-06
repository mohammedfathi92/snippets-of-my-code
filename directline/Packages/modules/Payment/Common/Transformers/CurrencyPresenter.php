<?php

namespace Packages\Modules\Payment\Common\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class CurrencyPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new CurrencyTransformer();
    }

}