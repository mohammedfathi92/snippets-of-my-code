<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace app\Http\Controllers;

use App\City;
use App\Http\Controllers\Controller;
use App\Setting;

class CitiesController extends Controller
{

    function show($id = 0, $slug = null)
    {
        $city = City::with('country')
            ->with('tabs')
            ->with('places')
            ->with('hotels')
            ->find($id);
        if (!$city) {
            return abort(404);
        }
        $this->data['city'] = $city;

        $this->data['title'] = trans("cities.frontend_city_page_title", ['city' => $city->name]) . " - " . $this->data['title'];
        $this->data['meta_description'] = $city->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $city->meta_keywords ?: $this->data['meta_keywords'];

        return view("frontend.cities.show", $this->data);
    }

    function hotels($id = 0, $slug = null)
    {
        $city = City::with('country')->find($id);
        if (!$city) {
            return abort(404);
        }

        $this->data['title'] = trans("hotels.page_title_city_hotels", ["city" => $city->name]) . " - " . $this->data['title'];
        $this->data['city'] = $city;
        $this->data['hotels'] = $city->hotels()->published()->paginate(20);
        return view("frontend.cities.hotels", $this->data);
    }

    function places($id = 0, $slug = null)
    {
        $city = City::with('country')->find($id);
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