<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class DriverPresenter extends FractalPresenter
{

    /**
     * @return DriverTransformer
     */
    public function getTransformer()
    {
        return new DriverTransformer();
    }
}