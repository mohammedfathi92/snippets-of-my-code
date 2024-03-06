<?php

namespace Corsata\Http\Controllers\backend;

use Corsata\Country;
use Corsata\BookedHousing;
use Corsata\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use Corsata\Http\Requests;
use Corsata\Http\Controllers\backend\BackendBaseController;

class BookedHousingsController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show housings")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['data'] = BookedHousing::all();

        return view("backend.housings.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create housings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $this->data['countries'] = Country::all();

        return view("backend.housings.create", $this->data);
    }

    function store(Request $request)
    {

        $rules = [
            'photo' => "required",
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $messages["name.$locale.required"] = trans("places.validation_name_locale_required", ['locale' => $properties['native']]);
        }
       
        $rules["country"] = "required";
        $rules["address_line1"] = "required";
        $rules["city"] = "required";
        $rules["type"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $housing = new BookedHousing();
        $housing->type = $request->input('type')?:'family';
        $housing->status = (boolean)$request->input('status');
        $housing->country_id = (int)$request->input('country');
        $housing->city_id = (int)$request->input('city');
        $housing->state = $request->input('state');
        $housing->address_line1 = $request->input('address_line1');
        $housing->beds_num = (int)$request->input('beds_num');
        $housing->address_line2 = $request->input('address_line2');
        $housing->phone_no1 = $request->input('phone_no1');
        $housing->phone_no2 = $request->input('phone_no2');
        $housing->phone_no3 = $request->input('phone_no3');
        $housing->email = $request->input('email');
        $housing->check_in = $request->input('check_in');
        $housing->check_out = $request->input('check_out');
       $housing->map = (int)$request->input('map');

        if ($request->input('photo')) {
            $housing->photo = $request->input('photo');
        }

        $housing->save();


        if ($housing->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $housing->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $housing->translateOrNew($locale)->description = $request->input('description.' . $locale);
                
            }

            $housing->save();
}

        if ($housing->save()) {

           

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
                            'module'    => 'housings',
                            'key'       => 'housing-gallery',
                            'module_id' => $housing->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }

        return redirect($this->data['backend_uri'] . "/housings")->with(['message' => trans("housings.success_created"), 'alert-type' => 'success']);


    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit housings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $housing = BookedHousing::find($id);
        if (!$housing) {
            flash(trans("housings.id_not_found"), 'danger');

            return redirect()->back();
        }

        $this->data['page_title'] = trans("housings.backend_page_title");
        $this->data['page_header'] = trans("housings.backend_page_create_header");
        $this->data['data'] = $housing;
        $this->data['countries'] = Country::all();

        return view("backend.housings.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit housings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $housing = BookedHousing::find($id);
        if (!$housing) {

            return redirect()->back()->with(['message' => trans("housings.id_not_found"), 'alert-type' => 'error']);
        }

        $rules = [
            'photo' => "required",
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            
            $messages["name.$locale.required"] = trans("housings.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["country"] = "required";
        $rules["address_line1"] = "required";
        $rules["city"] = "required";
        $rules["type"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $housing->type = $request->input('type')?:'family';
        $housing->status = (boolean)$request->input('status');
        $housing->country_id = (int)$request->input('country');
        $housing->city_id = (int)$request->input('city');
        $housing->state = $request->input('state');
        $housing->beds_num = (int)$request->input('beds_num');
        $housing->address_line1 = $request->input('address_line1');
        $housing->address_line2 = $request->input('address_line2');
        $housing->phone_no1 = $request->input('phone_no1');
        $housing->phone_no2 = $request->input('phone_no2');
        $housing->phone_no3 = $request->input('phone_no3');
        $housing->email = $request->input('email');
        $housing->check_in = $request->input('check_in');
        $housing->check_out = $request->input('check_out');
        $housing->map = (int)$request->input('map');

        if ($request->input('photo')) {
            $housing->photo = $request->input('photo');
        }


        if ($housing->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $housing->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $housing->translateOrNew($locale)->description = $request->input('description.' . $locale);
               
            }

            $housing->save();

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
                            'module'    => 'housings',
                            'key'       => 'housings-gallery',
                            'module_id' => $housing->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }

        return redirect($this->data['backend_uri'] . "/housings")->with(['message' => trans("housings.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete housings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $housing = BookedHousing::find($id);
        if (!$housing) {
            return redirect()->back()->with(['message' => trans("housings.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $housing->photo;
        $gallery = $housing->gallery;

        if ($housing->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("housings.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("housings.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete housings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $housing = BookedHousing::find($id);

                if ($housing) {
                    $defaultPhoto = $housing->photo;
                    $gallery = $housing->gallery;

                    if ($housing->delete()) {
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

            return redirect()->back()->with(["message" => trans("housings.success_multi_delete", ['count' => $deleted]), "alert-type" => "success"]);
        }

        return redirect()->back()->with(["message" => trans("housings.error_multi_delete_empty"), "alert-type" => "error"]);

    }


}
