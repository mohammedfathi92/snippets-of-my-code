<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Corsata\Http\Controllers;

use Corsata\Country;
use Corsata\FAQ;
use Corsata\FaqQuestion;
use Corsata\Institute;
use Corsata\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FAQController extends Controller
{

    function index()
    {
        $categories = FAQ::published();
        $this->data['title'] = trans("faq.frontend_page_title") . " - " . $this->data['title'];
        $this->data['categories'] = $categories;
        $this->data['questions'] = FaqQuestion::published()->paginate(20);
        return view("frontend.faq.index", $this->data);
    }

    function search(Request $request, $q = null)
    {
        if (!$q) $q = $request->input('q');
        $categories = FAQ::published();
        $this->data['title'] = trans("faq.frontend_page_title") . " - " . $this->data['title'];
        $this->data['categories'] = $categories;
        $this->data['questions'] = FaqQuestion::whereHas('translations', function ($query) use ($q) {
            $query->where("question", "like", "%$q%")->orWhere("answer", "like", "%$q%");
        })->paginate(20);
        return view("frontend.faq.search", $this->data);
    }

    function show($slug = null)
    {
        $category = FAQ::published()->whereSlug($slug)->first();
        if (!$category) {
            return abort(404);
        }
        $categories = FAQ::published();
        $this->data['category'] = $category;
        $this->data['categories'] = $categories;
        $this->data['questions'] = $category->questions()->paginate(20);
        $this->data['title'] = $category->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $category->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $category->meta_keywords ?: $this->data['meta_keywords'];
        return view("frontend.faq.index", $this->data);
    }

}