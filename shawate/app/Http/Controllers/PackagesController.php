<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 1/5/17
 * Time: 7:32 AM
 */

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Package;
use App\PackageType;

class PackagesController extends Controller
{
    function index()
    {
        $this->data['packages'] = Package::published()->paginate(20);
        $types = PackageType::published()->get();
        $this->data["types"] = $types;
        return view("frontend.packages.index", $this->data);

    }

    function show($id = 0, $slug = null)
    {
        $package = Package::published()->with("type")->with("gallery")->find($id);
        if (!$package)
            return abort(404);

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

        $this->data['packages'] = $type->packages()->published()->paginate(20);
        $this->data["type"] = $type;
        $this->data["country"] = $type->country;
        return view("frontend.packages.index", $this->data);
    }

}