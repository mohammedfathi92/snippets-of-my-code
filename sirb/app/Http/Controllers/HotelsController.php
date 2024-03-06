<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Sirb\Http\Controllers;

use Sirb\Country;
use Sirb\Hotel;
use Sirb\Setting;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Sirb\Http\Controllers\Controller;
use Spatie\SchemaOrg\Schema;

class HotelsController extends Controller
{

    function index()
    {
        $this->data['data'] = Country::published()->paginate(20);

        $this->data['hotels'] = Hotel::published()->latest()->paginate(20);


        $locale = LaravelLocalization::getCurrentLocale();
        $this->data['locale'] = $locale;

        //Replace in_item_code => in + country name && item_code => country nam

        $replacedWords = ["code_item", "in_code"];
        $newWords = ["", ""];
        $replace_title = str_replace($replacedWords, $newWords, settings("title_hotels_{$locale}"));

        $metaKeywords = str_replace($replacedWords, $newWords, settings("meta_tags_hotels_{$locale}"));

        $metaDescription = str_replace($replacedWords, $newWords, settings("meta_description_hotels_{$locale}"));

        $this->data['title'] = $replace_title ? $replace_title : trans("hotels.page_title") . " - " . $this->data['title'];

        $this->data['meta_keywords'] = $metaKeywords ? $metaKeywords : trans("hotels.page_title") . " - " . $this->data['title'];

        $this->data['meta_description'] = $metaDescription ? $metaDescription : trans("hotels.page_title") . " - " . $this->data['title'];
        return view("frontend.hotels.index", $this->data);
    }

    function show($id = 0, $slug = null)
    {


        $hotel = Hotel::published()->find($id);
        if (!$hotel) {
            return abort(404);
        }
        $hotelSchema = Schema::LodgingBusiness()->description($hotel->meta_description)
            ->image(url("files/{$hotel->photo}"))
            ->name($hotel->name)
            ->alternateName($this->data['locale'] == "ar" ? $hotel->{"name:en"} : $hotel->{"name:ar"})
            ->url(route('hotels.show', [$hotel->id, make_slug($hotel->name)]))
            ->checkinTime(date("H:i", strtotime("02:00")))
            ->checkoutTime(date("H:i", strtotime("12:00")))
            ->starRating($hotel->stars)
            ->telephone($this->phone)
            ->contactPoint(Schema::contactPoint()
                ->telephone($this->phone)
                ->areaServed('Worldwide')
                ->contactType("customer support"))
            ->paymentAccepted("Cash, Credit Card, Local Exchange ");

        $this->data['googleSchema'] = $hotelSchema;

        $this->data['data'] = $hotel;
        $this->data['title'] = $hotel->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $hotel->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $hotel->meta_keywords ?: $this->data['meta_keywords'];
        $this->data['rooms'] = $hotel->rooms()->where('status', true)->paginate(10, ['*'], 'rooms');
        $this->data['related'] = $hotel->city->hotels()->published($hotel->id);
        return view("frontend.hotels.show", $this->data);
    }
}
