<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class HotelPackagePresenter extends FractalPresenter
{

    /**
     * @return HotelPackageTransformer
     */
    public function getTransformer()
    {
        return new HotelPackageTransformer();
    }
}