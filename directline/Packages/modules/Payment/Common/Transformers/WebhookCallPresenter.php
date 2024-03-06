<?php

namespace Packages\Modules\Payment\Common\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class WebhookCallPresenter extends FractalPresenter
{

    /**
     * @return WebhookCallTransformer
     */
    public function getTransformer()
    {
        return new WebhookCallTransformer();
    }
}