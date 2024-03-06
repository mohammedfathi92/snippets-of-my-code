<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class PlacePresenter extends FractalPresenter
{

    /**
     * @return PlaceTransformer
     */
    public function getTransformer()
    {
        return new PlaceTransformer();
    }
}