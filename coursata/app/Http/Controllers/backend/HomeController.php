<?php

namespace Corsata\Http\Controllers\backend;

use Illuminate\Http\Request;

use Corsata\Http\Requests;
use Corsata\Http\Controllers\backend\BackendBaseController;

class HomeController extends BackendBaseController
{

    function index() {

	   return view("backend.home.index",$this->data);

    }
}
