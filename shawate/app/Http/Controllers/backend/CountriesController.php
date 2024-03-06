<?php

namespace App\Http\Controllers\backend;

use App\Country;
use App\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\backend\BackendBaseController;

class CountriesController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show countries")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['data'] = Country::orderBy("id", "desc")->get();

        return view("backend.countries.index", $this->data);
    }


    function create()
    {
        if (!Auth::user()->can("create countries")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("countries.backend_page_title");
        $this->data['page_header'] = trans("countries.backend_page_create_header");

        return view("backend.countries.create", $this->data);
    }

    function store(Request $request)
    {

        $rules = [
            'name.ar' => "required|max:255",
            'name.en' => "required|max:255",
            'photo'   => "required",
        ];

        $messages = [
            'name.ar.required' => trans("countries.validation_name_locale_required", ['locale' => "العربية"]),
            'name.en.required' => trans("countries.validation_name_locale_required", ['locale' => "English"]),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $country = new Country();
        $country->embed_video = $request->input('embed_video') ?: null;
        $country->map = $request->input('map') ?: null;
        $country->status = (boolean)$request->input('status');

        if ($request->input('flag')) {
            $country->flag = $request->input('flag');
        }
        if ($request->input('photo')) {
            $country->photo = $request->input('photo');
        }

        if ($country->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $country->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $country->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $country->translateOrNew($locale)->guide = $request->input('guide.' . $locale);
                $country->translateOrNew($locale)->notes = $request->input('notes.' . $locale);
                $country->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $country->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $country->save();

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
                            'module'    => 'countries',
                            'key'       => 'country-gallery',
                            'module_id' => $country->id,
                        ];
                    }
                }

                Media::insert($gallery);
            }

        }

        return redirect($this->data['backend_uri'] . "/countries")->with(['message' => trans("countries.success_created"), 'alert-type' => 'success']);


    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit countries")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $country = Country::find($id);
        if (!$country) {
            return redirect()->back()->with(['message' => trans("countries.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("countries.backend_page_title");
        $this->data['page_header'] = trans("countries.backend_page_create_header");
        $this->data['data'] = $country;

        return view("backend.countries.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit countries")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'warning']);
        }
        $rules = [
            'name.ar' => "required|max:255",
            'name.en' => "required|max:255",
        ];
        $messages = [
            'name.ar.required' => trans("countries.validation_name_locale_required", ['locale' => "العربية"]),
            'name.en.required' => trans("countries.validation_name_locale_required", ['locale' => "English"]),
        ];
        if (!$request->input('old_photo'))
            $rules['photo'] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $country = Country::find($id);
        $country->embed_video = $request->input('embed_video') ?: null;
        $country->map = $request->input('map') ?: null;
        $country->status = (boolean)$request->input('status');

        if ($request->input('flag')) {
            $country->flag = $request->input('flag');
        }
        if ($request->input('photo')) {
            $country->photo = $request->input('photo');
        }

        if ($country->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $country->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $country->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $country->translateOrNew($locale)->guide = $request->input('guide.' . $locale);
                $country->translateOrNew($locale)->notes = $request->input('notes.' . $locale);
                $country->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $country->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }
            $country->save();

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
                            'module'    => 'countries',
                            'key'       => 'country-gallery',
                            'module_id' => $country->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }
        return redirect($this->data['backend_uri'] . "/countries")
            ->with(['message' => trans("countries.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete countries")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $country = Country::find($id);
        if (!$country) {
            return redirect()->back()->with(['message' => trans("countries.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $country->flag;
        $photo = $country->photo;
        $gallery = $country->gallery;

        if ($country->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            $uploader->delete($photo);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("countries.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("countries.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete countries")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'warning']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $country = Country::find($id);

                if ($country) {
                    $photo = $country->photo;
                    $defaultPhoto = $country->flag;
                    $gallery = $country->gallery;

                    if ($country->delete()) {
                        $uploader = new UploaderController();
                        $uploader->delete($defaultPhoto);
                        $uploader->delete($photo);
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

            return redirect()->back()->with(['message' => trans("countries.success_multi_delete", ['count' => $deleted]), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("countries.error_multi_delete_empty"), 'alert-type' => 'warning']);

    }


}
