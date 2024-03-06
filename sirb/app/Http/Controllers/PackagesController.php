<?php
/**
 * Created by PhpStorm.
 * User: mohammed
 * Date: 1/5/17
 * Time: 7:32 AM
 */

namespace Sirb\Http\Controllers;

use Sirb\Http\Controllers\Controller;
use Sirb\Package;
use Sirb\Setting;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Sirb\PackageType;
use Spatie\SchemaOrg\Schema;

class PackagesController extends Controller
{
    function index()
    {
        $this->data['packages'] = Package::published()->latest()->paginate(20);
        $types = PackageType::published()->get();
        $this->data["types"] = $types;

        $locale = LaravelLocalization::getCurrentLocale();
        $this->data['locale'] = $locale;

        $replacedWords = ["code_item", "in_code"];
        $newWords = ["", ""];
        $replace_title = str_replace($replacedWords, $newWords, settings("title_packages_{$locale}"));

        $metaKeywords = str_replace($replacedWords, $newWords, settings("meta_tags_packages_{$locale}"));

        $metaDescription = str_replace($replacedWords, $newWords, settings("meta_description_packages_{$locale}"));

        $this->data['title'] = $replace_title ? $replace_title : trans("packages.page_title") . " - " . $this->data['title'];

        $this->data['meta_keywords'] = $metaKeywords ? $metaKeywords : trans("packages.page_title") . " - " . $this->data['title'];

        $this->data['meta_description'] = $metaDescription ? $metaDescription : trans("packages.page_title") . " - " . $this->data['title'];

        return view("frontend.packages.index", $this->data);

    }

    function show($id = 0, $slug = null)
    {
        $package = Package::published()->with("type")->with("gallery")->find($id);
        if (!$package)
            return abort(404);
        $packageSchema = Schema::offer();
        $packageSchema->url(route("packages.show", [$package->id, make_slug($package->name)]))
            ->name($package->name)
            ->description($package->meta_description)
            ->image(url("files/" . $package->photo))
            ->price($package->offer_price ? $package->offer_price : $package->price)
            ->priceCurrency(settings("{$this->data['locale']}_currency"))
            ->areaServed("Worldwide");

        $this->data['googleSchema'] = $packageSchema;
        $this->data['title'] = trim($package->name) . " - " . $this->data['title'];
        $this->data['meta_keywords'] = $package->meta_keywords;
        $this->data['meta_description'] = $package->meta_description;
        $this->data['package'] = $package;
        $this->data["country"] = $package->country;
        return view("frontend.packages.show", $this->data);
    }

    function type($id = 0, $slug = null)
    {
        $type = PackageType::published()->find($id);
        $this->data['title'] = trim($type->name) . " - " . $this->data['title'];
        $this->data['meta_keywords'] = $type->meta_keywords;
        $this->data['meta_description'] = $type->meta_description;

        $this->data['packages'] = $type->packages()->published()->latest()->paginate(20);
        $this->data["type"] = $type;
        $this->data["country"] = $type->country;
        return view("frontend.packages.index", $this->data);
    }

}
