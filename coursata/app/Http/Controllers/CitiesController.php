<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Corsata\Http\Controllers;

use Corsata\City;
use Corsata\Http\Controllers\Controller;
use Corsata\Setting;

class CitiesController extends Controller
{

    function show($id = 0, $slug = null)
    {
        $city = City::whereId($id)->with("institutes")->first();
        if (!$city) {
            return abort(404);
        }

        $this->data['title'] = $city->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $city->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $city->meta_keywords ?: $this->data['meta_keywords'];
        $this->data['city'] = $city;
        $this->data['country'] = $city->country()->get();
        $this->data['institutes'] = $city->institutes()->paginate(10);
        return view("frontend.cities.show", $this->data);
    }

    function institutes($id = 0, $slug = null)
    {
        $city = City::with('country')
            ->with('institutes')
            ->find($id);

        if (!$city) {
            return abort(404);
        }

        $this->data['title'] = trans("institutes.page_title_city_institutes", ["city" => $city->name]) . " - " . $this->data['title'];
        $this->data['city'] = $city;
        $this->data['institutes'] = $city->institutes()->published()->paginate(20);
        return view("frontend.cities.institutes", $this->data);
    }

    function places($id = 0, $slug = null)
    {
        $city = City::with('country')->with(['places' => function ($q) {
            return $q->published();
        }])->find($id);
        if (!$city) {
            return abort(404);
        }

        $this->data['title'] = trans("places.page_title_city_places", ["city" => $city->name]) . " - " . $this->data['title'];
        $this->data['city'] = $city;
        $this->data['places'] = $city->places()->published()->paginate(20);
        return view("frontend.cities.places", $this->data);
    }

    function packages($id = 0, $slug = null)
    {

    }

    function photos($id = 0, $slug = null)
    {

    }
}