<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class ServicePricePresenter extends FractalPresenter
{

    /**
     * @return ServiceTransformer
     */
    public function getTransformer()
    {
        return new ServiceTransformer();
    }
}