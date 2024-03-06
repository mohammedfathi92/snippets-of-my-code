<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Sirb\Http\Controllers;

use Sirb\Http\Controllers\Controller;
use Sirb\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    function index()
    {
        $this->data['posts'] = News::published()->paginate(10);
        $this->data['title'] = trans("news.page_title") . " - " . $this->data['title'];
        return view("frontend.news.index", $this->data);
    }

    function search(Request $request)
    {
        $q = $request->get("q");

        $this->data['posts'] = News::published()->whereHas("translations", function ($query) use ($q) {
            $query->where("name", "like", "%$q%")->orWhere("name", "like", "%$q%");
        })->paginate(10);
        $this->data['title'] = trans("news.page_title") . " - " . $this->data['title'];
        return view("frontend.news.search", $this->data);
    }

    function show($id = 0, $slug = null)
    {
        $post = News::published()->find($id);
        if (!$post) {
            return abort(404);
        }
        $this->data['title'] = $post->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $post->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $post->meta_keywords ?: $this->data['meta_keywords'];
        $this->data['post'] = $post;
        $this->data['related'] = News::published($post->id)->take(10);
        return view("frontend.news.show", $this->data);
    }

    function guide($id = 0, $slug = null)
    {
        $country = Country::with('cities')->with('tabs')->with(['places' => function ($q) {
            $q->inCountry();
        }])->with(['hotels' => function ($q) {
            $q->inCountry();
        }])->find($id);
        if (!$country) {
            return abort(404);
        }
        $this->data['title'] = trans("countries.title_country_guide", ['country' => $country->name]) . " - " . $this->data['title'];
        $this->data['meta_description'] = $country->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $country->meta_keywords ?: $this->data['meta_keywords'];
        $this->data['country'] = $country;
        return view("frontend.countries.guide", $this->data);
    }

    function hotels($id = 0, $slug = null)
    {
        $country = Country::with(['hotels' => function ($q) {
            return $q->published();
        }])->find($id);
        if (!$country) {
            return abort(404);
        }

        $this->data['title'] = trans("hotels.page_title_country_hotels", ["country" => $country->name]) . " - " . $this->data['title'];
        $this->data['country'] = $country;
        $this->data['hotels'] = $country->hotels()->published()->paginate(20);

        return view("frontend.countries.hotels", $this->data);
    }

    function places($id = 0, $slug = null)
    {
        $country = Country::with(['places' => function ($q) {
            return $q->published();
        }])->find($id);
        if (!$country) {
            return abort(404);
        }

        $this->data['title'] = trans("places.page_title_country_places", ["country" => $country->name]) . " - " . $this->data['title'];
        $this->data['country'] = $country;
        $this->data['places'] = $country->places()->published()->paginate(20);

        return view("frontend.countries.places", $this->data);
    }

    function packages($id = 0, $slug = null)
    {
        $country = Country::with(['packages' => function ($q) {
            return $q->published();
        }])->find($id);
        if (!$country) {
            return abort(404);
        }

        $this->data['title'] = trans("packages.title_country_packages", ["country" => $country->name]) . " - " . $this->data['title'];
        $this->data['country'] = $country;
        $this->data['packages'] = $country->packages()->published()->paginate(20);

        return view("frontend.countries.packages", $this->data);
    }

    function photos($id = 0, $slug = null)
    {

    }
}
