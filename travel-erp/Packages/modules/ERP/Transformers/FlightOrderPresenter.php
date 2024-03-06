<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class FlightOrderPresenter extends FractalPresenter
{

    /**
     * @return FlightOrderTransformer
     */
    public function getTransformer()
    {
        return new FlightOrderTransformer();
    }
}