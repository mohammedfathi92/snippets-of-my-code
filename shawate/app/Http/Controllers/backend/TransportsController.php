<?php

namespace App\Http\Controllers\backend;

use App\Country;
use App\Transport;
use App\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\backend\BackendBaseController;

class TransportsController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show transports")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("transports.backend_page_title");
        $this->data['page_header'] = trans("transports.backend_page_header");
        $this->data['data'] = Transport::all();

        return view("backend.transports.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create transports")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("transports.backend_page_title");
        $this->data['page_header'] = trans("transports.backend_page_create_header");
        $this->data['countries'] = Country::all();
        return view("backend.transports.create", $this->data);
    }

    function store(Request $request)
    {

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {

            $rules["name.$locale"]              = "required|max:255";
            $rules["meta_keywords.$locale"]     = "max:255";
            $rules["meta_description.$locale"]  = "max:255";
            $messages["name.$locale.required"]  = trans("transports.validation_name_locale_required", ['locale' => $properties['native']]);

        }

        $rules["country"] = "required";
        $rules["type"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $transport = new Transport();
        $transport_types = ['flight', 'ship', 'bus', 'car'];
        $transport->in_home = (boolean)$request->input('in_home');
        if ($request->input('type') && in_array($request->input('type'), $transport_types)) {
            $transport->type = $request->input('type');
        }

        $transport->status = (boolean)$request->input('status');
        $transport->country_id = (int)$request->input('country');
        $transport->city_id = (int)$request->input('city') ?: 0;

        if ($request->input('photo')) {
            $transport->photo = $request->input('photo');
        }

        if ($transport->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $transport->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $transport->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $transport->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $transport->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
                $transport->translateOrNew($locale)->company_name = $request->input('company.' . $locale);
            }

            $transport->save();

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
                            'module'    => 'transports',
                            'key'       => 'transport-gallery',
                            'module_id' => $transport->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }

        return redirect($this->data['backend_uri'] . "/transports")->with(['message' => trans("transports.success_created"), 'alert-type' => 'success']);


    }

    function edit($id = 0)
    {
        if (!Auth::user()->can("edit transports")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $transport = Transport::find($id);
        if (!$transport) {
            return redirect()->back()->with(['message' => trans("transports.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("transports.backend_page_title");
        $this->data['page_header'] = trans("transports.backend_page_create_header");
        $this->data['data'] = $transport;
        $this->data['countries'] = Country::all();

        return view("backend.transports.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit transports")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $transport = Transport::find($id);
        if (!$transport) {

            return redirect()->back()->with(['message' => trans("transports.id_not_found"), 'alert-type' => 'error']);
        }

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {

            $rules["name.$locale"]              = "required|max:255";
            $rules["meta_keywords.$locale"]     = "max:255";
            $rules["meta_description.$locale"]  = "max:255";
            $messages["name.$locale.required"]  = trans("transports.validation_name_locale_required", ['locale' => $properties['native']]);

        }

        $rules["country"] = "required";
        $rules["type"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $transport_types = ['flight', 'ship', 'bus', 'car'];
        $transport->in_home = (boolean)$request->input('in_home');
        if ($request->input('type') && in_array($request->input('type'), $transport_types)) {
            $transport->type = $request->input('type');
        }

        $transport->status = (boolean)$request->input('status');
        $transport->country_id = (int)$request->input('country');
        $transport->city_id = (int)$request->input('city') ?: 0;

        if ($request->input('photo')) {
            $transport->photo = $request->input('photo');
        }

        if ($transport->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $transport->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $transport->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $transport->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $transport->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
                $transport->translateOrNew($locale)->company_name = $request->input('company.' . $locale);
            }

            $transport->save();

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
                            'module'    => 'transports',
                            'key'       => 'transport-gallery',
                            'module_id' => $transport->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }

            if ($request->input("services") && is_array($request->input('services'))) {
                $transport->services()->sync($request->input('services'));
            }
        }

        return redirect($this->data['backend_uri'] . "/transports")->with(['message' => trans("transports.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete transports")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $transport = Transport::find($id);
        if (!$transport) {
            return redirect()->back()->with(['message' => trans("transports.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $transport->photo;
        $gallery = $transport->gallery;

        if ($transport->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("transports.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("transports.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete transports")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $transport = Transport::find($id);

                if ($transport) {
                    $defaultPhoto = $transport->photo;
                    $gallery = $transport->gallery;

                    if ($transport->delete()) {
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

            return redirect()->back()->with(['message' => trans("transports.success_multi_delete", ['count' => $deleted]), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("transports.error_multi_delete_empty"), 'alert-type' => 'warning']);

    }


}
