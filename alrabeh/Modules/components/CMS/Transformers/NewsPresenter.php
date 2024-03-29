<?php
/**
 * Created by PhpStorm.
 * User: iMak
 * Date: 11/19/17
 * Time: 8:58 AM
 */

namespace Modules\Components\CMS\Transformers;

use Modules\Foundation\Transformers\FractalPresenter;

class NewsPresenter extends FractalPresenter
{

    /**
     * @return NewsTransformer
     */
    public function getTransformer()
    {
        return new NewsTransformer();
    }
}
