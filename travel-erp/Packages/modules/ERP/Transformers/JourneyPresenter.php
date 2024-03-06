<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class JourneyPresenter extends FractalPresenter
{

    /**
     * @return JourneyTransformer
     */
    public function getTransformer()
    {
        return new JourneyTransformer();
    }
}