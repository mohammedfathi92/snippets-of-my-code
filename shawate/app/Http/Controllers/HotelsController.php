<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace app\Http\Controllers;

use App\Country;
use App\Hotel;
use App\Http\Controllers\Controller;

class HotelsController extends Controller
{

    function index()
    {
        $this->data['data'] = Hotel::published()->paginate(20);
        $this->data['title'] = trans("hotels.page_title") . " - " . $this->data['title'];
        return view("frontend.hotels.index", $this->data);
    }

    function show($id = 0, $slug = null)
    {
        $hotel = Hotel::published()->find($id);
        if (!$hotel) {
            return abort(404);
        }
        $this->data['data'] = $hotel;
        $this->data['title'] = $hotel->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $hotel->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $hotel->meta_keywords ?: $this->data['meta_keywords'];
        $this->data['rooms'] = $hotel->rooms()->paginate(10, ['*'], 'rooms');
        $this->data['related'] = $hotel->city->hotels()->published($hotel->id);
        return view("frontend.hotels.show", $this->data);
    }
}