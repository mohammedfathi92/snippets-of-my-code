<?php

namespace App\Http\Controllers\backend;

use App\Country;
use App\Hotel;
use App\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\backend\BackendBaseController;

class HotelsController extends BackendBaseController
{
    function index()
    {
        if (!Auth::user()->can("show hotels")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $this->data['data'] = Hotel::all();

        return view("backend.hotels.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create hotels")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("hotels.backend_page_title");
        $this->data['page_header'] = trans("hotels.backend_page_create_header");
        $this->data['countries'] = Country::all();

        return view("backend.hotels.create", $this->data);
    }

    function store(Request $request)
    {

        $rules = [
            'photo' => "required",
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("hotels.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["country"] = "required";
        $rules["city"] = "required";
        $rules["address"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $hotel = new Hotel();
        $hotel->in_home = (boolean)$request->input('in_home');
        $hotel->in_country = (boolean)$request->input('in_country');
        $hotel->status = (boolean)$request->input('status');
        $hotel->price = (float)$request->input('price');
        $hotel->offer_price = (float)$request->input('offer_price');
        $hotel->season_price = (float)$request->input('season_price');
        $hotel->country_id = (int)$request->input('country');
        $hotel->address = $request->input('address');
        $hotel->embed_video = $request->input('embed_video');
        $hotel->stars = (int)$request->input('stars') ?: 1;
        $hotel->city_id = (int)$request->input('city');
        $hotel->map = $request->input('map');

        if ($request->input('photo')) {
            $hotel->photo = $request->input('photo');
        }

        if ($hotel->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $hotel->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $hotel->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $hotel->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $hotel->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
                $hotel->translateOrNew($locale)->notes = $request->input('notes.' . $locale);
            }

            $hotel->save();

            if ($request->input("gallery") and is_array($request->input("gallery"))) {
                $gallery = [];
                foreach ($request->input("gallery") as $image) {

                    $upload_dir = config("settings.upload_dir");
                    $upload_path = config("settings.upload_path");

                    if (Storage::disk("public")->exists($upload_dir . "/$image")) {
                        $ext = File::extension($upload_path . "/$image");
                        $mim = File::mimeType($upload_path . "/$image");
                        $gallery[] = [
                            'title'     => $image,
                            'name'      => $image,
                            'full_path' => Storage::url($upload_dir . "/$image"),
                            'extension' => $ext,
                            'mime_type' => $mim,
                            'module'    => 'hotels',
                            'key'       => 'hotel-gallery',
                            'module_id' => $hotel->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }


            if ($request->input("services") && is_array($request->input('services'))) {
                $hotel->services()->sync($request->input('services'));
            }
        }

        return redirect($this->data['backend_uri'] . "/hotels")->with(['message' => trans("hotels.success_created"), 'alert-type' => 'success']);


    }

    function edit($id = 0)
    {
        if (!Auth::user()->can("edit hotels")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $hotel = Hotel::find($id);
        if (!$hotel) {
            return redirect()->back()->with(['message' => trans("hotels.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("hotels.backend_page_title");
        $this->data['page_header'] = trans("hotels.backend_page_create_header");
        $this->data['data'] = $hotel;
        $this->data['countries'] = Country::all();

        return view("backend.hotels.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit hotels")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $hotel = Hotel::find($id);
        if (!$hotel) {

            return redirect()->back()->with(['message' => trans("hotels.id_not_found"), 'alert-type' => 'error']);
        }

        $rules = [
            'photo' => "required",
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("hotels.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["country"] = "required";
        $rules["city"] = "required";
        $rules["address"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $hotel->in_home = (boolean)$request->input('in_home');
        $hotel->in_country = (boolean)$request->input('in_country');
        $hotel->status = (boolean)$request->input('status');
        $hotel->price = (float)$request->input('price');
        $hotel->offer_price = (float)$request->input('offer_price');
        $hotel->season_price = (float)$request->input('season_price');
        $hotel->country_id = (int)$request->input('country');
        $hotel->address = $request->input('address');
        $hotel->embed_video = $request->input('embed_video');
        $hotel->stars = (int)$request->input('stars') ?: 1;
        $hotel->city_id = (int)$request->input('city');
        $hotel->map = $request->input('map');

        if ($request->input('photo')) {
            $hotel->photo = $request->input('photo');
        }


        if ($hotel->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $hotel->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $hotel->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $hotel->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $hotel->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
                $hotel->translateOrNew($locale)->notes = $request->input('notes.' . $locale);
            }

            $hotel->save();

            if ($request->input("gallery") and is_array($request->input("gallery"))) {
                $gallery = [];
                foreach ($request->input("gallery") as $image) {

                    $upload_dir = config("settings.upload_dir");
                    $upload_path = config("settings.upload_path");

                    if (Storage::disk("public")->exists($upload_dir . "/$image")) {
                        $ext = File::extension($upload_path . "/$image");
                        $mim = File::mimeType($upload_path . "/$image");
                        $gallery[] = [
                            'title'     => $image,
                            'name'      => $image,
                            'full_path' => Storage::url($upload_dir . "/$image"),
                            'extension' => $ext,
                            'mime_type' => $mim,
                            'module'    => 'hotels',
                            'key'       => 'hotel-gallery',
                            'module_id' => $hotel->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }

            if ($request->input("services") && is_array($request->input('services'))) {
                $hotel->services()->sync($request->input('services'));
            }
        }

        return redirect($this->data['backend_uri'] . "/hotels")->with(['message' => trans("hotels.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete hotels")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $hotel = Hotel::find($id);
        if (!$hotel) {
            return redirect()->back()->with(['message' => trans("hotels.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $hotel->photo;
        $gallery = $hotel->gallery;

        if ($hotel->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("hotels.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("hotels.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete hotels")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $hotel = Hotel::find($id);

                if ($hotel) {
                    $defaultPhoto = $hotel->photo;
                    $gallery = $hotel->gallery;

                    if ($hotel->delete()) {
                        $uploader = new UploaderController();
                        $uploader->delete($defaultPhoto);
                        // delete photos from storage and database
                        if ($gallery) {
                            foreach ($gallery as $file) {

                                $uploader->delete($file->name);
                            }
                        }
                    }

                    $deleted++;
                }
            }

            return redirect()->back()->with(['message' => trans("hotels.success_multi_delete", ['count' => $deleted]), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("hotels.error_multi_delete_empty"), 'alert-type' => 'warning']);

    }


}
