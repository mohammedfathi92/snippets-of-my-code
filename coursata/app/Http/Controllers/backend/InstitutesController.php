<?php

namespace Corsata\Http\Controllers\backend;

use Corsata\Country;
use Corsata\Institute;
use Corsata\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use Corsata\Http\Requests;
use Corsata\Http\Controllers\backend\BackendBaseController;

class InstitutesController extends BackendBaseController
{
    function index()
    {
        if (!Auth::user()->can("show institutes")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $this->data['title'] = trans("institutes.backend_page_title");
        $this->data['data'] = Institute::all();

        return view("backend.institutes.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create institutes")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['title'] = trans("institutes.backend_page_create_header");
        $this->data['countries'] = Country::all();

        return view("backend.institutes.create", $this->data);
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
            $messages["name.$locale.required"] = trans("institutes.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["country"] = "required";
        $rules["city"] = "required";


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $institute = new Institute();

        $institute->country_id = (int)$request->input('country');
        $institute->city_id = (int)$request->input('city');
        $institute->email = $request->input('email') ?: null;
        $institute->website = $request->input('website') ?: null;
        $institute->locale_rate = (int)$request->input('locale_rate') ?: 1;
        $institute->international_rate = (int)$request->input('international_rate') ?: 1;
        $institute->phone = $request->input('phone') ?: null;
        $institute->location_type = (int)$request->input('location_type') ?: 1;
        $institute->featured = (boolean)$request->input('featured');
        $institute->in_home = (boolean)$request->input('in_home');
        $institute->status = (boolean)$request->input('status');

        $institute->map_address = $request->input('formatted_address') ?: null;
        $institute->map_lat = $request->input('lat') ?: null;
        $institute->map_lng = $request->input('lng') ?: null;

        $institute->video_youtube = $request->input('video_youtube') ?: null;
        if ($request->input('photo')) {
            $institute->photo = $request->input('photo');
        }
        if ($request->input('logo')) {
            $institute->logo = $request->input('logo');
        }
        if ($request->input('brochures')) {
            $institute->brochures = $request->input('brochures');
        }

        if ($institute->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $institute->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $institute->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $institute->translateOrNew($locale)->address = $request->input('address.' . $locale);
                $institute->translateOrNew($locale)->bank_account = $request->input('bank_account.' . $locale);
                $institute->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $institute->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);

            }

            $institute->save();

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
                            'module'    => 'institutes',
                            'key'       => 'institute-gallery',
                            'module_id' => $institute->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }


            if ($request->input("services") && is_array($request->input('services'))) {
                $institute->services()->sync($request->input('services'));
            }
        }

        return redirect($this->data['backend_uri'] . "/institutes/list")->with(['message' => trans("institutes.success_created"), 'alert-type' => 'success']);


    }

    function edit($id = 0)
    {

        if (!Auth::user()->can("edit institutes")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $institute = Institute::find($id);
        if (!$institute) {
            return redirect()->back()->with(['message' => trans("institutes.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("institutes.backend_page_title");
        $this->data['page_header'] = trans("institutes.backend_page_create_header");
        $this->data['data'] = $institute;
        $this->data['countries'] = Country::all();

        return view("backend.institutes.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
         
        if (!Auth::user()->can("edit institutes")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $institute = Institute::find($id);
        if (!$institute) {

            return redirect()->back()->with(['message' => trans("institutes.id_not_found"), 'alert-type' => 'error']);
        }
        $rules = [
            'photo' => "required",
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("institutes.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["country"] = "required";
        $rules["city"] = "required";


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $institute->country_id = (int)$request->input('country');
        $institute->city_id = (int)$request->input('city');
        $institute->email = $request->input('email') ?: null;
        $institute->website = $request->input('website') ?: null;
        $institute->locale_rate = (int)$request->input('locale_rate') ?: 1;
        $institute->international_rate = (int)$request->input('international_rate') ?: 1;
        $institute->phone = $request->input('phone') ?: null;

        $institute->map_address = $request->input('formatted_address') ?: null;
        $institute->map_lat = $request->input('lat') ?: null;
        $institute->map_lng = $request->input('lng') ?: null;
        
        $institute->location_type = (int)$request->input('location_type') ?: 1;
        $institute->featured = (boolean)$request->input('featured');
        $institute->in_home = (boolean)$request->input('in_home');
        $institute->status = (boolean)$request->input('status');
        
        $institute->video_youtube = $request->input('video_youtube') ?: null;
        if ($request->input('photo')) {
            $institute->photo = $request->input('photo');
        }
        if ($request->input('logo')) {
            $institute->logo = $request->input('logo');
        }

        if ($request->input('brochures')) {
            $institute->brochures = $request->input('brochures');
        }

        if ($institute->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $institute->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $institute->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $institute->translateOrNew($locale)->address = $request->input('address.' . $locale);
                $institute->translateOrNew($locale)->bank_account = $request->input('bank_account.' . $locale);
                $institute->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $institute->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);

            }

            $institute->save();

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
                            'module'    => 'institutes',
                            'key'       => 'institute-gallery',
                            'module_id' => $institute->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }


            if ($request->input("services") && is_array($request->input('services'))) {
                $institute->services()->sync($request->input('services'));
            }
        }

        return redirect($this->data['backend_uri'] . "/institutes/list")->with(['message' => trans("institutes.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete institutes")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $institute = Institute::find($id);
        if (!$institute) {
            return redirect()->back()->with(['message' => trans("institutes.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $institute->photo;
        $logo = $institute->logo;
        $brochures = $institute->brochures;
        $gallery = $institute->gallery;

        if ($institute->delete()) {
            $uploader = new UploaderController();
            if($logo){
                $uploader->delete($logo);
            }

            if($brochures){
                $uploader->delete($brochures);
            }
            
            $uploader->delete($brochures);
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("institutes.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("institutes.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete institutes")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $institute = Institute::find($id);

                if ($institute) {
                    $defaultPhoto = $institute->photo;
                    $logo = $institute->logo;
                    $brochures = $institute->brochures;

                    $gallery = $institute->gallery;

                    if ($institute->delete()) {
                        $uploader = new UploaderController();
                        $uploader->delete($defaultPhoto);
                         if($logo){
                $uploader->delete($logo);
                  }

                 if($brochures){
                $uploader->delete($brochures);
                  }

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

            return redirect()->back()->with(['message' => trans("institutes.success_multi_delete", ['count' => $deleted]), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("institutes.error_multi_delete_empty"), 'alert-type' => 'warning']);

    }


}
