<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Sirb\Http\Controllers;

use Sirb\Country;
use Sirb\FAQ;
use Sirb\FaqQuestion;
use Sirb\Hotel;
use Sirb\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\SchemaOrg\Schema;

class FAQController extends Controller
{

    function index()
    {
        $categories = FAQ::published();

        $this->data['googleSchema'] = $this->googleSchema(trans("faq.frontend_page_title"), route("faq.index"));
        $this->data['title'] = trans("faq.frontend_page_title") . " - " . $this->data['title'];
        $this->data['categories'] = $categories;
        $this->data['questions'] = FaqQuestion::published()->orderBy("sort")->paginate(20);
        return view("frontend.faq.index", $this->data);
    }

    function search(Request $request, $q = null)
    {
        if (!$q) $q = $request->input('q');
        $categories = FAQ::published();
        $this->data['googleSchema'] = $this->googleSchema(trans("faq.title_search_results"), route('faq.search'));
        $this->data['title'] = trans("faq.frontend_page_title") . " - " . $this->data['title'];
        $this->data['categories'] = $categories;
        $this->data['questions'] = FaqQuestion::whereHas('translations', function ($query) use ($q) {
            $query->where("question", "like", "%$q%")->orWhere("answer", "like", "%$q%");
        })->orderBy("sort")->paginate(20);
        return view("frontend.faq.search", $this->data);
    }

    function show($slug = null)
    {
        $category = FAQ::published()->whereSlug($slug)->first();
        if (!$category) {
            return abort(404);
        }
        $categories = FAQ::published();
        $questions = $category->questions()->orderBy("sort")->paginate(20);
        $this->data['googleSchema'] = $this->googleSchema($category->name, route("faq.show", [$category->slug]));
        $this->data['category'] = $category;
        $this->data['categories'] = $categories;
        $this->data['questions'] = $questions;
        $this->data['title'] = $category->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $category->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $category->meta_keywords ?: $this->data['meta_keywords'];
        return view("frontend.faq.index", $this->data);
    }

    function googleSchema($title = null, $url = null)
    {
        Schema::qAPage()
            ->isAccessibleForFree(true)
            ->url($url)
            ->name($title);

    }

}
