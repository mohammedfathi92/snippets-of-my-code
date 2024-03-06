<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Sirb\Http\Controllers;

use Sirb\Place;
use Illuminate\Http\Request;
use Sirb\Setting;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Sirb\Http\Controllers\Controller;
use Spatie\SchemaOrg\Schema;

class PlacesController extends Controller
{

    function index()
    {
        $locale = LaravelLocalization::getCurrentLocale();
        $this->data['locale'] = $locale;

        $this->data['data'] = Place::published()->latest()->paginate(20);
        $replacedWords = ["code_item", "in_code"];
        $newWords = ["", ""];

        $replace_title = str_replace($replacedWords, $newWords, settings("title_places_{$locale}"));

        $metaKeywords = str_replace($replacedWords, $newWords, settings("meta_tags_places_{$locale}"));

        $metaDescription = str_replace($replacedWords, $newWords, settings("meta_description_places_{$locale}"));

        $this->data['title'] = $replace_title ? $replace_title : trans("places.page_title") . " - " . $this->data['title'];

        $this->data['meta_keywords'] = $metaKeywords ? $metaKeywords : trans("places.page_title") . " - " . $this->data['title'];

        $this->data['meta_description'] = $metaDescription ? $metaDescription : trans("places.page_title") . " - " . $this->data['title'];


        return view("frontend.places.index", $this->data);
    }

    function show(Request $request, $id = 0, $slug = null)
    {
        $place = Place::published()->with("city")->find($id);
        if (!$place) {
            return abort(404);
        }

        $placeSchema = Schema::place();
//        $placeSchema->address($place->address);
        $placePhotos = $place->gallery->map(function ($photo) {
            return $photo->name = url("files/$photo->name");
        })->toArray();

        $placeSchema->geo($place->map)
            ->url(route("places.show", [$place->id, $place->name]))
            ->name($place->name)
            ->description($place->meta_description)
            ->image(url("files/$place->photo"))
            ->photos($placePhotos);


        $this->data['data'] = $place;
        $this->data['title'] = $place->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $place->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $place->meta_keywords ?: $this->data['meta_keywords'];
        $this->data['related'] = $place->city->places()->published($place->id);
        return view("frontend.places.show", $this->data);
    }


    function photos($id = 0, $slug = null)
    {

    }
}
