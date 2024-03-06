<?php

namespace Modules\Components\CMS\Transformers;

use Modules\Foundation\Transformers\FractalPresenter;

class PostPresenter extends FractalPresenter
{

    /**
     * @return PostTransformer
     */
    public function getTransformer()
    {
        return new PostTransformer();
    }
}
