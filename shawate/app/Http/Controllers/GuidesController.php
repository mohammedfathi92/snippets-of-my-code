<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace app\Http\Controllers;

use App\Article;
use App\Category;
use App\Country;
use App\Http\Controllers\Controller;

class GuidesController extends Controller
{

    function index()
    {
        return view("frontend.countries.index", $this->data);
    }

    function show($id = 0, $slug = null)
    {
        $category = Category::with('articles')->with(['articles' => function ($q) {
            $q->published();
        }])->find($id);
        if (!$category) {
            return abort(404);
        }

        $this->data['title'] = $category->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $category->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $category->meta_keywords ?: $this->data['meta_keywords'];
        $this->data['category'] = $category;
        $this->data['topics'] = $category->articles()->orderBy("updated_at", "desc")->paginate(20);
        $this->data['country'] = $category->country;
        return view("frontend.guides.show", $this->data);
    }

    function topic($category_id, $id = 0, $slug = null)
    {

        $category = Category::published()->find($category_id);
        if (!$category) {
            return abort(404);
        }
        $topic = $category->articles()->published()->find($id);

        if (!$topic) {
            return abort(404);
        }


        $this->data['title'] = $topic->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $topic->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $topic->meta_keywords ?: $this->data['meta_keywords'];
        $this->data['category'] = $category;
        $this->data['topic'] = $topic;
        $this->data['country'] = $category->country;
        return view("frontend.guides.topic", $this->data);
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