<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class PackagePresenter extends FractalPresenter
{

    /**
     * @return PackageTransformer
     */
    public function getTransformer()
    {
        return new PackageTransformer();
    }
}