<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class BranchPresenter extends FractalPresenter
{

    /**
     * @return BranchTransformer
     */
    public function getTransformer()
    {
        return new BranchTransformer();
    }
}