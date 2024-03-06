<?php
/**
 * @project     : blog
 * @file        : BaseAdminController.php
 * @created_at  : 3/5/16 - 12:20 AM
 * @author      : Mohammed Fathi (mohammedfathi1113@gmail.com)
 **/


namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Auth;



abstract class BaseAdminController extends Controller
{

    function __construct()
    {
        parent::__construct();

        /*if (!\Auth::user()) {
            if(!($request->is('admin/login') || $request->is('admin/logout'))){
                return redirect("admin/login")->send();
            }

        }*/
    }
}