<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class FerryPresenter extends FractalPresenter
{

    /**
     * @return ProviderTransformer
     */
    public function getTransformer()
    {
        return new FerryTransformer();
    }
}