<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\backend\BackendBaseController;

class HomeController extends BackendBaseController
{

    function index() {

	   return view("backend.home.index",$this->data);

    }
}
