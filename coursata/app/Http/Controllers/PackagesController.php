<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 1/5/17
 * Time: 7:32 AM
 */

namespace Corsata\Http\Controllers;

use Corsata\Http\Controllers\Controller;
use Corsata\Package;
use Corsata\PackageType;

class PackagesController extends Controller
{
    function index()
    {
        $this->data['packages'] = Package::published()->paginate(20);
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
        return view("frontend.packages.show", $this->data);
    }

    function type($id = 0, $slug = null)
    {
        $type = PackageType::published()->with(["packages" => function ($q) {
            $q->published();
        }])->find($id);
        $this->data['packages'] = $type->packages()->paginate(20);
        $this->data["type"] = $type;
        return view("frontend.packages.index", $this->data);
    }

}