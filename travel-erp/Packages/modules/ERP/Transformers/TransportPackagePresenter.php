<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class TransportPackagePresenter extends FractalPresenter
{

    /**
     * @return TransportPackageTransformer
     */
    public function getTransformer()
    {
        return new TransportPackageTransformer();
    }
}