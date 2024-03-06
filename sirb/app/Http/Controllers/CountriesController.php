<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Sirb\Http\Controllers;

use Sirb\Country;
use Sirb\City;
use Sirb\Setting;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Sirb\Http\Controllers\Controller;

class CountriesController extends Controller
{

    function index()
    {
        $this->data['title']=trans("countries.page_title")." - ".$this->data['title'];
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

      $locale = LaravelLocalization::getCurrentLocale();
       $this->data['locale'] = $locale;

       $replacedWords = ["code_item", "in_code"];
       $newWords = [$country->name, trans("main.in_letter")." ".$country->name];


        $replace_title = str_replace($replacedWords, $newWords, settings("title_countries_dest_{$locale}"));

        $this->data['title'] = $replace_title? $replace_title : trans("countries.destination_page_title", ['name' => $country->name]) . " - " . $this->data['title'];
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

       $this->data['cities'] = $country->cities()->published()->paginate(20);



       $locale = LaravelLocalization::getCurrentLocale();
       $this->data['locale'] = $locale;

       //Replace in_code => in + country name && item_code => country nam
       $replacedWords = ["code_item", "in_code"];
       $newWords = [$country->name, trans("main.in_letter")." ".$country->name];


        $replace_title = str_replace($replacedWords, $newWords, settings("title_hotels_{$locale}"));

        $metaKeywords = str_replace($replacedWords, $newWords, settings("meta_tags_hotels_{$locale}"));

        $metaDescription = str_replace($replacedWords, $newWords, settings("meta_description_hotels_{$locale}"));

       $this->data['title'] = $replace_title? $replace_title : trans("hotels.page_title_country_hotels", ["country" => $country->name]). " - " . $this->data['title'];

       $this->data['meta_keywords'] = $metaKeywords? $metaKeywords : trans("hotels.page_title_country_hotels", ["country" => $country->name]);

       $this->data['meta_description'] = $metaDescription? $metaDescription : trans("hotels.page_title_country_hotels", ["country" => $country->name]);

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

        $this->data['cities'] = $country->cities()->published()->paginate(20);

        $locale = LaravelLocalization::getCurrentLocale();
       $this->data['locale'] = $locale;

       //Replace in_item_code => in + country name && item_code => country nam
       $replacedWords = ["code_item", "in_code"];
       $newWords = [$country->name, trans("main.in_letter")." ".$country->name];


        $replace_title = str_replace($replacedWords, $newWords, settings("title_places_{$locale}"));

        $metaKeywords = str_replace($replacedWords, $newWords, settings("meta_tags_places_{$locale}"));

        $metaDescription = str_replace($replacedWords, $newWords, settings("meta_description_places_{$locale}"));

       $this->data['title'] = $replace_title? $replace_title : trans("places.page_title_country_places", ["country" => $country->name]). " - " . $this->data['title'];

       $this->data['meta_keywords'] = $metaKeywords? $metaKeywords : trans("places.page_title_country_places", ["country" => $country->name]);

       $this->data['meta_description'] = $metaDescription? $metaDescription : trans("places.page_title_country_places", ["country" => $country->name]);

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

        $this->data['cities'] = $country->cities()->published()->paginate(20);

       $locale = LaravelLocalization::getCurrentLocale();
       $this->data['locale'] = $locale;

       //Replace in_item_code => in + country name && item_code => country nam
       $replacedWords = ["code_item", "in_code"];
       $newWords = [$country->name, trans("main.in_letter")." ".$country->name];


        $replace_title = str_replace($replacedWords, $newWords, settings("title_packages_{$locale}"));

        $metaKeywords = str_replace($replacedWords, $newWords, settings("meta_tags_packages_{$locale}"));

        $metaDescription = str_replace($replacedWords, $newWords, settings("meta_description_packages_{$locale}"));

       $this->data['title'] = $replace_title? $replace_title : trans("packages.title_country_packages", ["country" => $country->name]). " - " . $this->data['title'];

       $this->data['meta_keywords'] = $metaKeywords? $metaKeywords : trans("packages.title_country_packages", ["country" => $country->name]);

       $this->data['meta_description'] = $metaDescription? $metaDescription : trans("packages.title_country_packages", ["country" => $country->name]);


        $this->data['country'] = $country;
        $this->data['packages'] = $country->packages()->published()->latest()->paginate(20);

        return view("frontend.countries.packages", $this->data);
    }

    function cities($id = 0, $slug = null)
    {

        $country = Country::find($id);
        if (!$country) {
            return abort(404);
        }

        $this->data['cities'] = $country->cities()->published()->paginate(20);


        $locale = LaravelLocalization::getCurrentLocale();
       $this->data['locale'] = $locale;

       //Replace in_item_code => in + country name && item_code => country nam

       $replacedWords = ["code_item", "in_code"];
       $newWords = [$country->name, trans("main.in_letter")." ".$country->name];

        $replace_title = str_replace($replacedWords, $newWords, settings("title_cities_{$locale}"));

        $metaKeywords = str_replace($replacedWords, $newWords, settings("meta_tags_cities_{$locale}"));

        $metaDescription = str_replace($replacedWords, $newWords, settings("meta_description_cities_{$locale}"));

       $this->data['title'] = $replace_title? $replace_title : trans("cities.page_title_country_cities", ["country" => $country->name]). " - " . $this->data['title'];

       $this->data['meta_keywords'] = $metaKeywords? $metaKeywords : trans("cities.page_title_country_cities", ["country" => $country->name]);

       $this->data['meta_description'] = $metaDescription? $metaDescription : trans("cities.page_title_country_cities", ["country" => $country->name]);





        $this->data['country'] = $country;
        $this->data['cities'] = $country->cities()->published()->paginate(20);

        return view("frontend.countries.cities", $this->data);
    }



}
