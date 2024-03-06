<?php

namespace Packages\Modules\Larashop\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class AttributePresenter extends FractalPresenter
{

    /**
     * @return AttributeTransformer
     */
    public function getTransformer()
    {
        return new AttributeTransformer();
    }
}