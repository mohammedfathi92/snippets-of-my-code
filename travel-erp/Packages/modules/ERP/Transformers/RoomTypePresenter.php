<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class RoomTypePresenter extends FractalPresenter
{

    /**
     * @return RoomTypeTransformer
     */
    public function getTransformer()
    {
        return new RoomTypeTransformer();
    }
}