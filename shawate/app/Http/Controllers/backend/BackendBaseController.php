<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Settings;
use Javascript;

class BackendBaseController extends Controller
{

    function __construct()
    {
        parent::__construct();
        $backend_uri = config("settings.backend_uri");
        $this->data['backend_uri'] = $backend_uri;

        if ($uri = Settings::get('backend_uri')) {
            $this->data['backend_uri'] = $uri;
        }
        $javascript_vars=['backend_uri'=>$this->data['backend_uri']];

        Javascript::put($javascript_vars);

    }
}
