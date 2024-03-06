<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class FlightPackagePresenter extends FractalPresenter
{

    /**
     * @return FlightPackageTransformer
     */
    public function getTransformer()
    {
        return new FlightPackageTransformer();
    }
}