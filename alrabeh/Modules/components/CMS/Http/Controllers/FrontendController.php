<?php

namespace Modules\Components\CMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\PublicBaseController;
use Modules\Components\CMS\Models\Content;
use Modules\Components\CMS\Traits\CMSControllerFunctions;

class FrontendController extends PublicBaseController
{
    public $view_prefix = '';
    public $internalState = false;

    use CMSControllerFunctions;

    public function __construct()
    {
        $this->resetContentQuery();

        parent::__construct();
    }
}
