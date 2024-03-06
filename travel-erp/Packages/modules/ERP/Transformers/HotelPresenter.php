<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class HotelPresenter extends FractalPresenter
{

    /**
     * @return CategoryTransformer
     */
    public function getTransformer()
    {
        return new HotelTransformer();
    }
}