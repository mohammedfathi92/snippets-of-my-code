<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class TourPresenter extends FractalPresenter
{

    /**
     * @return TravelTransformer
     */
    public function getTransformer()
    {
        return new TourTransformer();
    }
}