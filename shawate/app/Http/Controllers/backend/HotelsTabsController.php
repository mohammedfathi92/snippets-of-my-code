<?php

namespace App\Http\Controllers\backend;

use App\City;
use App\Hotel;
use App\Tab;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

//use App\Http\Controllers\backend\BackendBaseController;

class HotelsTabsController extends BackendBaseController
{
    function index($hotel_id = 0)
    {
        if (!Auth::user()->can("show hotels")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $hotel = Hotel::find($hotel_id);

        if (!$hotel) {

            return redirect()->back()->with(['message' => trans("hotels.id_not_found"), 'alert-type' => 'error']);
        }
        $this->data['hotel'] = $hotel;
        $this->data['hotel'] = $hotel;

        $this->data['method'] = "post";

        return view("backend.hotels.tabs.index", $this->data);
    }

    function create($hotel_id = 0)
    {
        if (!Auth::user()->can("create hotels")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $hotel = Hotel::find($hotel_id);

        if (!$hotel) {

            return redirect()->back()->with(['message' => trans("hotels.id_not_found"), 'alert-type' => 'error']);
        }
        $this->data['hotel'] = $hotel;

        $this->data['method'] = "post";

        return view("backend.hotels.tabs.index", $this->data);
    }

    function store(Request $request, $hotel_id = 0)
    {
        $rules = [];
        $messages = [];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["title.$locale"] = "required|max:255";
            $messages["title.$locale.required"] = trans("tabs.validation_name_locale_required", ['locale' => $properties['native']]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tab = new Tab();

        $tab->photo = $request->input('photo') ?: null;
        $tab->sort = (int)$request->input('sort') ?: 1;
        $tab->module_id = $hotel_id;
        $tab->key = "hotel-tab";

        if ($tab->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $tab->translateOrNew($locale)->title = $request->input('title.' . $locale);
                $tab->translateOrNew($locale)->description = $request->input('description.' . $locale);
            }

            $tab->save();
        }

        return redirect($this->data['backend_uri'] . "/hotels/$hotel_id/tabs")->with(['message' => trans("hotels.tabs.success_created"), 'alert-type' => 'success']);
    }

    function edit($hotel_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit hotels")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $tab = Tab::find($id);
        if (!$tab) {

            return redirect()->back()->with(['message' => trans("hotels.tabs.id_not_found"), 'alert-type' => 'error']);
        }


        $hotel = Hotel::find($hotel_id);

        if (!$hotel) {

            return redirect()->back()->with(['message' => trans("hotels.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['hotel'] = $hotel;

        $this->data['data'] = $tab;
        $this->data['method'] = 'put';

        return view("backend.hotels.tabs.index", $this->data);
    }

    function update(Request $request, $hotel_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit hotels")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $rules = [];
        $messages = [];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["title.$locale"] = "required|max:255";
            $messages["title.$locale.required"] = trans("tabs.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tab = Tab::find($id);

        $tab->photo = $request->input('photo') ?: $request->input("old_photo") ?: null;
        $tab->sort = (int)$request->input('sort') ?: 1;
        $tab->module_id = $hotel_id;
        $tab->key = "hotel-tab";

        if ($tab->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $tab->translateOrNew($locale)->title = $request->input('title.' . $locale);
                $tab->translateOrNew($locale)->description = $request->input('description.' . $locale);
            }

            $tab->save();

        }
        return redirect($this->data['backend_uri'] . "/hotels/$hotel_id/tabs")
            ->with(['message' => trans("hotels.tabs.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $hotel_id = 0, $id = 0)
    {
        if (!Auth::user()->can("delete hotels")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $tab = Tab::find($id);
        if (!$tab) {

            return redirect()->back()->with(['message' => trans("hotels.tabs.id_not_found"), 'alert-type' => 'error']);
        }


        $hotel = Hotel::find($hotel_id);

        if (!$hotel) {

            return redirect()->back()->with(['message' => trans("hotels.id_not_found"), 'alert-type' => 'error']);
        }

        // get service photos
        $defaultPhoto = $tab->photo;

        if ($tab->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);

            return redirect("/" . $this->data['backend_uri'] . "/hotels/$hotel_id/tabs")->with(['message' => trans("hotels.tabs.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect("/" . $this->data['backend_uri'] . "/hotels/$hotel_id/tabs")->with(['message' => trans("hotels.tabs.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete hotels")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $tab = Tab::find($id);

                if ($tab) {
                    $defaultPhoto = $tab->photo;
                    if ($tab->delete()) {
                        $uploader = new UploaderController();
                        $uploader->delete($defaultPhoto);
                        // delete photos from storage and database
                    }

                    $deleted++;
                }
            }


            return redirect()->back()->with(['message' => trans("hotels.tabs.success_multi_delete", ['count' => $deleted]), 'alert-type' => "success"]);
        }

        return redirect()->back()->with(['message' => trans("hotels.tabs.error_multi_delete_empty"), 'alert-type' => "warning"]);

    }
}
