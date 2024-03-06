<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class FlightPricePresenter extends FractalPresenter
{

    /**
     * @return VehicleTransformer
     */
    public function getTransformer()
    {
        return new FlightPriceTransformer();
    }
}