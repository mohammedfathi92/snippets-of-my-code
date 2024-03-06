<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Sirb\Http\Controllers;

use Sirb\City;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Sirb\Http\Controllers\Controller;
use Sirb\Setting;

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



      $locale = LaravelLocalization::getCurrentLocale();
       $this->data['locale'] = $locale;


        $replacedWords = ["code_item", "in_code"];
       $newWords = [$city->name, trans("main.in_letter")." ".$city->name];


        $replace_title = str_replace($replacedWords, $newWords, settings("title_city_dest_{$locale}"));

        $this->data['city'] = $city;

        $this->data['title'] = $replace_title? $replace_title : trans("countries.destination_page_title", ['name' => $city->name]) . " - " . $this->data['title'];
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

        $country = $city->country()->first();
         $this->data['country'] = $country;

       $locale = LaravelLocalization::getCurrentLocale();
       $this->data['locale'] = $locale;

       //Replace in_item_code => in + country name && item_code => country nam
       $replacedWords = ["code_item", "in_code"];
       $newWords = [$city->name, trans("main.in_letter")." ".$city->name];


        $replace_title = str_replace($replacedWords, $newWords, settings("title_hotels_{$locale}"));

        $metaKeywords = str_replace($replacedWords, $newWords, settings("meta_tags_hotels_{$locale}"));

        $metaDescription = str_replace($replacedWords, $newWords, settings("meta_description_hotels_{$locale}"));

       $this->data['title'] = $replace_title? $replace_title : trans("hotels.page_title_city_hotels", ["city" => $city->name]). " - " . $this->data['title'];

       $this->data['meta_keywords'] = $metaKeywords? $metaKeywords : trans("hotels.page_title_city_hotels", ["city" => $city->name]);

       $this->data['meta_description'] = $metaDescription? $metaDescription : trans("hotels.page_title_city_hotels", ["city" => $city->name]);

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


        $country = $city->country()->first();
         $this->data['country'] = $country;

       $locale = LaravelLocalization::getCurrentLocale();
       $this->data['locale'] = $locale;

       //Replace in_item_code => in + country name && item_code => country nam
        $replacedWords = ["code_item", "in_code"];
       $newWords = [$city->name, trans("main.in_letter")." ".$city->name];


        $replace_title = str_replace($replacedWords, $newWords, settings("title_places_{$locale}"));

        $metaKeywords = str_replace($replacedWords, $newWords, settings("meta_tags_places_{$locale}"));

        $metaDescription = str_replace($replacedWords, $newWords, settings("meta_description_places_{$locale}"));

       $this->data['title'] = $replace_title? $replace_title : trans("places.page_title_city_places", ["city" => $city->name]). " - " . $this->data['title'];

       $this->data['meta_keywords'] = $metaKeywords? $metaKeywords : trans("places.page_title_city_places", ["city" => $city->name]);

       $this->data['meta_description'] = $metaDescription? $metaDescription : trans("places.page_title_city_places", ["city" => $city->name]);


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
