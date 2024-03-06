<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Corsata\Http\Controllers;

use Corsata\Country;
use Corsata\Http\Controllers\Controller;

class CountriesController extends Controller
{

    function index()
    {
        $countries = Country::whereHas("institutes", function ($q) {
            $q->whereStatus(true);
        })->paginate(10);
        $this->data['countries'] = $countries;

        $this->data['title'] = trans("countries.frontend_page_title") . " - " . $this->data['title'];
        return view("frontend.countries.index", $this->data);

    }

    function show($code = null, $slug = null)
    {
        $country = Country::whereCode($code)->with("institutes")->first();
        if (!$country) {
            return abort(404);
        }

        $this->data['title'] = $country->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $country->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $country->meta_keywords ?: $this->data['meta_keywords'];
        $this->data['country'] = $country;
        $this->data['institutes'] = $country->institutes()->paginate(10);
        return view("frontend.countries.show", $this->data);
    }

   
    function institutes($code)
    {
        $country = Country::with(['institutes' => function ($q) {
            return $q->published();
        }])->find($id);
        if (!$country) {
            return abort(404);
        }

        $this->data['title'] = trans("institutes.page_title_country_institutes", ["country" => $country->name]) . " - " . $this->data['title'];
        $this->data['country'] = $country;
        $this->data['institutes'] = $country->institutes()->published()->paginate(20);

        return view("frontend.countries.institutes", $this->data);
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




    function cities($code = null, $slug = null)
    {

        $country = Country::whereCode($code)->first();
        if (!$country)
            return abort(404);
        $this->data['title'] = $country->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $country->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $country->meta_keywords ?: $this->data['meta_keywords'];
        $this->data['country'] = $country;
        $this->data['cities'] = $country->cities()->whereHas("institutes", function ($q) {
            $q->whereStatus(true);
        })->paginate(10);
        return view("frontend.countries.cities", $this->data);

    }

}