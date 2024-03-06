<?php

namespace App\Http\Controllers\manage;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManageController extends Controller
{

    function __construct()
    {
        parent::__construct();

        if (!Auth::user()->permission < 2) {
            return redirect("/");
        }

    }
}
