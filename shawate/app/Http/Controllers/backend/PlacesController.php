<?php

namespace App\Http\Controllers\backend;

use App\Country;
use App\Place;
use App\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\backend\BackendBaseController;

class PlacesController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show places")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['data'] = Place::all();

        return view("backend.places.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create places")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $this->data['countries'] = Country::all();

        return view("backend.places.create", $this->data);
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
            $messages["name.$locale.required"] = trans("places.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["country"] = "required";
        $rules["city"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $place = new Place();
        $place->embed_video = $request->input('embed_video')?:null;
        $place->in_home = (boolean)$request->input('in_home');
        $place->status = (boolean)$request->input('status');
        $place->country_id = (int)$request->input('country');
        $place->city_id = (int)$request->input('city');
        $place->map = $request->input('map');

        if ($request->input('photo')) {
            $place->photo = $request->input('photo');
        }


        if ($place->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $place->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $place->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $place->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $place->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
                $place->translateOrNew($locale)->notes = $request->input('notes.' . $locale);
            }

            $place->save();

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
                            'module'    => 'places',
                            'key'       => 'place-gallery',
                            'module_id' => $place->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }

        return redirect($this->data['backend_uri'] . "/places")->with(['message' => trans("places.success_created"), 'alert-type' => 'success']);


    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit places")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $place = Place::find($id);
        if (!$place) {
            flash(trans("places.id_not_found"), 'danger');

            return redirect()->back();
        }

        $this->data['page_title'] = trans("places.backend_page_title");
        $this->data['page_header'] = trans("places.backend_page_create_header");
        $this->data['data'] = $place;
        $this->data['countries'] = Country::all();

        return view("backend.places.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit places")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $place = Place::find($id);
        if (!$place) {

            return redirect()->back()->with(['message' => trans("places.id_not_found"), 'alert-type' => 'error']);
        }

        $rules = [
            'photo' => "required",
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("places.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["country"] = "required";
        $rules["city"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $place->embed_video = $request->input('embed_video')?:null;
        $place->in_home = (boolean)$request->input('in_home');
        $place->status = (boolean)$request->input('status');
        $place->country_id = (int)$request->input('country');
        $place->city_id = (int)$request->input('city');
        $place->map = $request->input('map');

        if ($request->input('photo')) {
            $place->photo = $request->input('photo');
        }


        if ($place->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $place->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $place->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $place->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $place->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
                $place->translateOrNew($locale)->notes = $request->input('notes.' . $locale);
            }

            $place->save();

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
                            'module'    => 'places',
                            'key'       => 'place-gallery',
                            'module_id' => $place->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }

        return redirect($this->data['backend_uri'] . "/places")->with(['message' => trans("places.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete places")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $place = Place::find($id);
        if (!$place) {
            return redirect()->back()->with(['message' => trans("places.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $place->photo;
        $gallery = $place->gallery;

        if ($place->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("places.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("places.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete places")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $place = Place::find($id);

                if ($place) {
                    $defaultPhoto = $place->photo;
                    $gallery = $place->gallery;

                    if ($place->delete()) {
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

            return redirect()->back()->with(["message" => trans("places.success_multi_delete", ['count' => $deleted]), "alert-type" => "success"]);
        }

        return redirect()->back()->with(["message" => trans("places.error_multi_delete_empty"), "alert-type" => "error"]);

    }


}
