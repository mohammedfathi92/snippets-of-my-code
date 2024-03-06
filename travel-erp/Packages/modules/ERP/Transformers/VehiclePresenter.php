<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class VehiclePresenter extends FractalPresenter
{

    /**
     * @return VehicleTransformer
     */
    public function getTransformer()
    {
        return new VehicleTransformer();
    }
}