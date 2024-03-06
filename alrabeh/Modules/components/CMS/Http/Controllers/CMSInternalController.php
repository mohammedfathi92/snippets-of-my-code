<?php

namespace Modules\Components\CMS\Http\Controllers;

use Modules\Foundation\Http\Controllers\BaseController;
use Modules\Components\CMS\Traits\CMSControllerFunctions;

class CMSInternalController extends BaseController
{
    public $view_prefix = '';
    public $internalState = true;

    use CMSControllerFunctions;

    public function __construct()
    {
        $this->view_prefix = 'CMS::cms_internal';

        $this->resetContentQuery();

        parent::__construct();
    }


}
