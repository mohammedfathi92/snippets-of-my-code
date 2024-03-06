<?php
/**
 * @project     : blog
 * @file        : DashboardController.php
 * @created_at  : 3/5/16 - 12:48 AM
 * @author      : Mohammed Fathi (mohammedfathi1113@gmail.com)
 **/
namespace App\Http\Controllers\backend;


use App\Category;
use App\Product;

class DashboardController extends BaseAdminController
{
    function __construct()
    {
        parent::__construct();
    }

    function index(){

        $this->data['page_title']   =   "Control Panel";
        $this->data['products']     = Product::latest()->get();
        $this->data['slides']     = Product::latest()->where('show_in_home',1)->get();
        $this->data['categories']     = Category::latest()->get();
        return view("backend.admin.dashboard",$this->data);
    }

}