<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace app\Http\Controllers;

use App\Country;
use App\Http\Controllers\Controller;

class CountriesController extends Controller
{

    function index()
    {
        return view("frontend.countries.index", $this->data);
    }

    function show($id = 0, $slug = null)
    {
        $country = Country::with(['cities' => function ($q) {
            $q->published()->inCountry();
        }])->with('tabs')->with(['places' => function ($q) {
            $q->inCountry();
        }])->with(['hotels' => function ($q) {
            $q->where("status",true)->where("in_country",true);
        }])->find($id);
        if (!$country) {
            return abort(404);
        }
        $this->data['title'] = trans("countries.destination_page_title", ['name' => $country->name]) . " - " . $this->data['title'];
        $this->data['meta_description'] = $country->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $country->meta_keywords ?: $this->data['meta_keywords'];
        $this->data['country'] = $country;
        return view("frontend.countries.show", $this->data);
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
        $country = Country::find($id);
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
        $country = Country::find($id);
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
        $country = Country::find($id);
        if (!$country) {
            return abort(404);
        }

        $this->data['title'] = trans("packages.title_country_packages", ["country" => $country->name]) . " - " . $this->data['title'];
        $this->data['country'] = $country;
        $this->data['packages'] = $country->packages()->published()->paginate(20);

        return view("frontend.countries.packages", $this->data);
    }

    function cities($id = 0, $slug = null)
    {

        $country = Country::find($id);
        if (!$country) {
            return abort(404);
        }

        $this->data['title'] = trans("cities.page_title_country_cities", ["country" => $country->name]) . " - " . $this->data['title'];
        $this->data['country'] = $country;
        $this->data['cities'] = $country->cities()->published()->paginate(20);

        return view("frontend.countries.cities", $this->data);
    }
}