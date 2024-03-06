<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class MenuRoomPresenter extends FractalPresenter
{

    /**
     * @return MenuRoomTransformer
     */
    public function getTransformer()
    {
        return new MenuRoomTransformer();
    }
}