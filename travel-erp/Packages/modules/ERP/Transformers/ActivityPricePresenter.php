<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class ActivityPricePresenter extends FractalPresenter
{

    /**
     * @return ProviderTransformer
     */
    public function getTransformer()
    {
        return new ActivityPriceTransformer();
    }
}