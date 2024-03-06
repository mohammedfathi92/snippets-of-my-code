<?php

namespace Modules\Components\CMS\Transformers;

use Modules\Foundation\Transformers\FractalPresenter;

class PagePresenter extends FractalPresenter
{

    /**
     * @return PageTransformer
     */
    public function getTransformer()
    {
        return new PageTransformer();
    }
}
