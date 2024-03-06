<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class ServicePresenter extends FractalPresenter
{

    /**
     * @return ServiceTransformer
     */
    public function getTransformer()
    {
        return new ServiceTransformer();
    }
}