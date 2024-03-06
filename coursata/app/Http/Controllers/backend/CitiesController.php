<?php

namespace Corsata\Http\Controllers\backend;

use Corsata\City;
use Corsata\Country;
use Corsata\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use Corsata\Http\Requests;
use Corsata\Http\Controllers\backend\BackendBaseController;

class CitiesController extends BackendBaseController
{
    function index($country_id = 0)
    {

        if (!Auth::user()->can("show cities")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $country = Country::find($country_id);
        if (!$country) {
            return redirect()->back()->with(['message' => trans("main.error_id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("cities.backend_page_title");
        $this->data['page_header'] = trans("cities.backend_page_header");
        $this->data['data'] = $country->cities;
        $this->data['country'] = $country;

        return view("backend.cities.index", $this->data);
    }

    function create($country_id = 0)
    {
        if (!Auth::user()->can("create cities")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $country = Country::find($country_id);
        if (!$country) {
            return redirect()->back()->with(['message' => trans("main.error_id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("cities.backend_page_title");
        $this->data['page_header'] = trans("cities.backend_page_create_header");
        $this->data['country'] = $country;

        return view("backend.cities.create", $this->data);
    }

    function store(Request $request, $country_id = 0)
    {
        $country = Country::find($country_id);
        if (!$country) {
            return redirect()->back()->with(['message' => trans("main.error_id_not_found"), 'alert-type' => 'error']);
        }

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $messages["name.$locale.required"] = trans("cities.validation_name_in_locale_required", ["locale" => $locale]);
        }
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $city = new City();
        $city->country_id = $country->id;
        $city->state_id = $request->input('state_id') ?: null;
        $city->is_state = (bool)$request->input('is_state');
        $city->map_address = $request->input('formatted_address') ?: null;
        $city->map_lat = $request->input('lat') ?: null;
        $city->map_lng = $request->input('lng') ?: null;

        if ($request->input('photo')) {
            $city->photo = $request->input('photo');
        }
        $city->save();

        if ($city->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $city->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $city->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $city->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $city->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }
            $city->save();

        }

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
                            'module'    => 'cities',
                            'key'       => 'city-gallery',
                            'module_id' => $city->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }


        return redirect($this->data['backend_uri'] . "/countries/$country->id/cities")->with(['message' => trans("cities.success_created"), 'alert-type' => 'success']);


    }


    function edit($country_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit cities")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $country = Country::find($country_id);
        if (!$country) {
            return redirect()->back()->with(['message' => trans("main.error_id_not_found"), 'alert-type' => 'error']);
        }

        $city = City::find($id);
        if (!$city) {
            flash(trans("cities.id_not_found"), 'danger');

            return redirect()->back();
        }

        $this->data['page_title'] = trans("cities.backend_page_title");
        $this->data['page_header'] = trans("cities.backend_page_create_header");
         $this->data['country'] = $country;
        $this->data['data'] = $city;

        return view("backend.cities.edit", $this->data);
    }

    function update(Request $request, $country_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit cities")) {
            flash(trans("permissions.permission_denied"), "warning");
            return redirect()->back();
        }


        $country = Country::find($country_id);
        if (!$country) {
            return redirect()->back()->with(['message' => trans("main.error_id_not_found"), 'alert-type' => 'error']);
        }

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $messages["name.$locale.required"] = trans("cities.validation_name_in_locale_required", ["locale" => $locale]);
        }
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $city = City::find($id);
        $city->country_id = $country->id;
        $city->state_id = $request->input('state_id') ?: null;
        $city->is_state = (bool)$request->input('is_state');

        $city->map_address = $request->input('formatted_address') ?: null;
        $city->map_lat = $request->input('lat') ?: null;
        $city->map_lng = $request->input('lng') ?: null;

        if ($request->input('photo')) {
            $city->photo = $request->input('photo');
        }
        $city->save();

        if ($city->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $city->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $city->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $city->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $city->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }
            $city->save();

        }


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
                            'module'    => 'cities',
                            'key'       => 'city-gallery',
                            'module_id' => $city->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }


        return redirect($this->data['backend_uri'] . "/countries/$country->id/cities")
            ->with(['message' => trans("cities.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $country_id = 0, $id = 0)
    {
        if (!Auth::user()->can("delete cities")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }



        $city = City::find($id);
        if (!$city) {
            return redirect()->back()->with(['message' => trans("cities.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $city->photo;
        $gallery = $city->gallery;


        if ($city->delete()) {

            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }
            return redirect()->back()->with(['message' => trans("cities.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("cities.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request, $country_id = 0)
    {
        if (!Auth::user()->can("delete cities")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $city = City::find($id);

                if ($city) {

                    $defaultPhoto = $city->photo;
                    $gallery = $city->gallery;

                    if ($city->delete()) {
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


            return redirect()->back()->with([trans("cities.success_multi_delete", ['count' => $deleted]), 'alert-type' => "success"]);
        }
        return redirect()->back()->with([trans("cities.error_multi_delete_empty"), 'alert-type' => "error"]);;

    }


}
