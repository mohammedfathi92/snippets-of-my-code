<?php

namespace Packages\Modules\Payment\Common\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class InvoicePresenter extends FractalPresenter
{

    /**
     * @return InvoiceTransformer
     */
    public function getTransformer()
    {
        return new InvoiceTransformer();
    }
}