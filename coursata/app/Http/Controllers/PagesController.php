<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Corsata\Http\Controllers;

use Corsata\Country;
use Corsata\Institute;
use Corsata\Http\Controllers\Controller;
use Corsata\Page;

class PagesController extends Controller
{

    function show($slug = null)
    {
        $page = Page::whereSlug($slug)->first();
        if (!$page) {
            return abort(404);
        }
        $this->data['data'] = $page;
        $this->data['title'] = $page->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $page->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $page->meta_keywords ?: $this->data['meta_keywords'];
        return view("frontend.pages.show", $this->data);
    }

    function courses($id = 0, $slug = null)
    {

    }

    function photos($id = 0, $slug = null)
    {

    }
}