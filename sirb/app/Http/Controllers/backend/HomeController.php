<?php

namespace Sirb\Http\Controllers\backend;

use Illuminate\Http\Request;

use Sirb\Http\Requests;
use Sirb\Http\Controllers\backend\BackendBaseController;

class HomeController extends BackendBaseController
{

    function index() {

	   return view("backend.home.index",$this->data);

    }
}
