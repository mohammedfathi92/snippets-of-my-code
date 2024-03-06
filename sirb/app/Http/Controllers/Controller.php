<?php

namespace Sirb\Http\Controllers;

use Sirb\Setting;
use Carbon\Carbon;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\SchemaOrg\Schema;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Javascript;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = ['title', 'page_title' => null, 'page_header' => null, 'locale' => null, 'googleSchema' => null];
    protected $localBusiness;
    protected $phone = null;
    protected $settings = [];

    function __construct()
    {
        $locale = LaravelLocalization::getCurrentLocale();

        $this->data['locale'] = $locale;
        $this->data['title'] = settings("{$locale}_title");
        $this->data['application_name'] = settings("{$locale}_title");
        $this->data['meta_keywords'] = settings("{$locale}_meta_keywords");
        $this->data['meta_description'] = settings("{$locale}_meta_description");

        Carbon::setLocale($this->data['locale']);
        $this->phone = explode(",", str_replace(" ", "", settings("help_phone")));
        if ($this->phone and is_array($this->phone))
            $this->phone = $this->phone[0];

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

    function index()
    {

    }


}
