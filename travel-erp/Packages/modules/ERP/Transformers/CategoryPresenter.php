<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class CategoryPresenter extends FractalPresenter
{

    /**
     * @return CategoryTransformer
     */
    public function getTransformer()
    {
        return new CategoryTransformer();
    }
}