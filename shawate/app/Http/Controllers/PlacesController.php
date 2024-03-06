<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Place;
use Illuminate\Http\Request;

class PlacesController extends Controller
{

    function index()
    {
        $this->data['data'] = Place::published()->paginate(20);
        return view("frontend.places.index", $this->data);
    }

    function show(Request $request, $id = 0, $slug = null)
    {
        $place = Place::published()->with("city")->find($id);
        if (!$place) {
            return abort(404);
        }
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