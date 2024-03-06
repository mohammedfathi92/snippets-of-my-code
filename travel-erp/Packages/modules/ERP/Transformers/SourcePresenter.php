<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class SourcePresenter extends FractalPresenter
{

    /**
     * @return SourceTransformer
     */
    public function getTransformer()
    {
        return new SourceTransformer();
    }
}