<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class ManualHotelOrderPresenter extends FractalPresenter
{

    /**
     * @return ManualHotelOrderTransformer
     */
    public function getTransformer()
    {
        return new ManualHotelOrderTransformer();
    }
}