<?php

namespace Corsata\Http\Controllers;

use Corsata\Setting;
use Carbon\Carbon;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Session;
use Swap\Laravel\Facades\Swap;
use View;
use Javascript;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = ['title', 'page_title' => null, 'page_header' => null, 'locale' => null];

    function __construct()
    {
        $locale = LaravelLocalization::getCurrentLocale();
        $this->data['locale'] = $locale;
        $this->data['title'] = Setting::get("{$locale}_title");
        $this->data['application_name'] = Setting::get("{$locale}_title");
        $this->data['application_name'] = Setting::get("{$locale}_title");
        $this->data['meta_keywords'] = Setting::get("{$locale}_meta_keywords");
        $this->data['meta_description'] = Setting::get("{$locale}_meta_description");
        Carbon::setLocale($this->data['locale']);

   

    
        $user = null;
        if (\Auth::user()) {
            $user = \Auth::user();
        }
        $javascript_vars = [
            "csrfToken" => csrf_token(),
            "locale"    => $locale,
            "user"      => $user,
            "jsTrans"   => trans("main.js"),
        ];

        Javascript::put($javascript_vars);
    }


}
