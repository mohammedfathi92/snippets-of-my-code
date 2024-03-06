<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\FractalPresenter;

class AgentPresenter extends FractalPresenter
{

    /**
     * @return AgentTransformer
     */
    public function getTransformer()
    {
        return new AgentTransformer();
    }
}