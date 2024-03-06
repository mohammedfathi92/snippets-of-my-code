<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class HotelOrderPresenter extends FractalPresenter
{

    /**
     * @return HotelOrderTransformer
     */
    public function getTransformer()
    {
        return new HotelOrderTransformer();
    }
}