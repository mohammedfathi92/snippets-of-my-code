<?php

namespace Sirb\Http\Controllers;

use Sirb\LandingPage;
use Sirb\LandingBlock;
use Sirb\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use Sirb\Http\Requests;

class LandingPagesController extends Controller
{
    function index()
    {


    }

    function show($slug = null)
    {
        $page = LandingPage::whereSlug($slug)->first();
        if (!$page) {
            return abort(404);
        }
        $this->data['page'] = $page;
        $this->data['blocks'] = $page->blocks()->get();
        $this->data['title'] = $page->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $page->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $page->meta_keywords ?: $this->data['meta_keywords'];
        return view("frontend.landing_pages.show", $this->data);
    }


}
