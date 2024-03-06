<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    function index()
    {

        return view("frontend.home.index", $this->data);
    }
}