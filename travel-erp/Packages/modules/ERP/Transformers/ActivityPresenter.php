<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class ActivityPresenter extends FractalPresenter
{

    /**
     * @return ProviderTransformer
     */
    public function getTransformer()
    {
        return new ActivityTransformer();
    }
}