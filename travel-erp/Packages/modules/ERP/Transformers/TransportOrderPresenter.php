<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class TransportOrderPresenter extends FractalPresenter
{

    /**
     * @return TransportOrderTransformer
     */
    public function getTransformer()
    {
        return new TransportOrderTransformer();
    }
}