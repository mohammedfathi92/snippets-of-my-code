<?php

namespace Modules\Components\Payments\Transformers;

use Modules\Foundation\Transformers\FractalPresenter;

class BarPresenter extends FractalPresenter
{

    /**
     * @return BarTransformer
     */
    public function getTransformer()
    {
        return new BarTransformer();
    }
}
