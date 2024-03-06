<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class AirportPresenter extends FractalPresenter
{

    /**
     * @return AirportTransformer
     */
    public function getTransformer()
    {
        return new AirportTransformer();
    }
}