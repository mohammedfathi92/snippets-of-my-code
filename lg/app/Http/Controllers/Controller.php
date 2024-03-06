<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use LaravelLocalization;
use Carbon\Carbon;

class Controller extends BaseController
{

    protected $data = ['app_title' => "", 'page_header' => "", 'page_title' => "", "locale" => ""];
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    function __construct()
    {

        $this->data['locale']=LaravelLocalization::getCurrentLocale();
        Carbon::setLocale($this->data['locale']);
        $this->data['menuCategories']=Category::latest()->get();
    }
}
