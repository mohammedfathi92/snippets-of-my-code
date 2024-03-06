<?php

namespace Sirb\Http\Controllers\backend;

use Sirb\Country;
use Sirb\Package;
use Sirb\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;
use Sirb\Http\Requests;
use Sirb\Http\Controllers\backend\BackendBaseController;

class PackagesController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show packages")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("packages.backend_page_title");
        $this->data['page_header'] = trans("packages.backend_page_header");
        $this->data['data'] = Package::all();

        return view("backend.packages.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create packages")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['countries'] = Country::all();

        return view("backend.packages.create", $this->data);
    }

    function store(Request $request)
    {


        $rules = [
            'photo' => "required",
        ];
        $messages = [];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("packages.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["type"] = "required";
        // $rules["order"] = "required|unique|integer";
        $rules["country"] = "required";


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $package = new Package();
        $package->in_country = (boolean)$request->input('in_country');

        $package->embed_video = $request->input('embed_video') ?: null;
        $package->in_home = (boolean)$request->input('in_home');
        $package->days = (int)$request->input('days');
        $package->status = (boolean)$request->input('status');
        $package->adults_count = (int)$request->input('adults_count');
        $package->childrens_count = (int)$request->input('childrens_count');
        $package->babies_count = (int)$request->input('babies_count');
        $package->price = (float)$request->input('price');
        $package->offer_price = (float)$request->input('offer_price');
        $package->season_price = (float)$request->input('season_price');
        $package->country_id = (int)$request->input('country');
        $package->type_id = (int)$request->input('type');
        $package->level = (int)$request->input('stars') ?: 3;

        if ($request->input('photo')) {
            $package->photo = $request->input('photo');
        }


        if ($package->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $package->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $package->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $package->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $package->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
                $package->translateOrNew($locale)->notes = $request->input('notes.' . $locale);
            }

            $days = 0;
            // save hotels and rooms
            if ($request->input('rooms') && is_array($request->input('rooms'))) {

                $rooms = [];
                for ($i = 0; $i < count($request->input("rooms.room")); $i++) {
                    $rooms[] = ['room_id'     => $request->input("rooms.room.$i"),
                                'hotel_id'    => (int)$request->input("rooms.hotel.$i"),
                                'city_id'     => (int)$request->input("rooms.city.$i"),
                                'days'        => (int)$request->input("rooms.days.$i"),
                                'order'       => (int)$request->input("rooms.order.$i"),
                                'rooms_count' => (int)$request->input("rooms.rooms_count.$i")
                    ];
                    $days += (int)$request->input("rooms.days.$i") ?: 1;
                }
                $package->rooms()->detach();
                $package->rooms()->sync($rooms);
            }
            $package->days = $days;


            if ($request->input('transports') && is_array($request->input('transports'))) {
                $transports = [];

                for ($i = 0; $i < count($request->input("transports.transport")); $i++) {
                    $transports[] = ['transport_id' => (int)$request->input("transports.transport.$i"),
                                     'city_id'      => (int)$request->input("transports.city.$i"), 'order' => (int)$request->input("order_transports"), 'order' => (int)$request->input("transports.order.$i")];

                }
                $package->transports()->detach();
                $package->transports()->sync($transports);
            }

            if ($request->input('flights') && is_array($request->input('flights'))) {
                $flights = [];
                for ($i = 0; $i < count($request->input("flights.flight")); $i++) {
                    $flights[] = ['flight_id'       => (int)$request->input("flights.flight.$i"),
                                  'from_country_id' => (int)$request->input("flights.from_country.$i"),
                                  'from_city_id'    => (int)$request->input("flights.from_city.$i"),
                                  'to_country_id'   => (int)$request->input("flights.to_country.$i"),
                                  'to_city_id'      => (int)$request->input("flights.to_city.$i"), 'order' => (int)$request->input("flights.order.$i")];
                }
                $package->flights()->detach();
                $package->flights()->sync($flights);
            }


            $package->save();

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
                            'module'    => 'packages',
                            'key'       => 'package-gallery',
                            'module_id' => $package->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }

//return redirect($this->data['backend_uri'] . "/packages")->with(['message' => trans("packages.success_created"), 'alert-type' => 'success']);

        return redirect()->back()->with(['message' => trans("packages.success_created"), 'alert-type' => 'success']);


    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit packages")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $package = Package::find($id);
        if (!$package) {
            return redirect()->back()->with(['message' => trans("packages.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("packages.backend_page_title");
        $this->data['page_header'] = trans("packages.backend_page_create_header");
        $this->data['data'] = $package;
        $this->data['countries'] = Country::all();

        return view("backend.packages.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {


        if (!Auth::user()->can("edit packages")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $package = Package::find($id);
        if (!$package) {

            return redirect()->back()->with(['message' => trans("packages.id_not_found"), 'alert-type' => 'error']);
        }
        $rules = [];
        $messages = [];

        if (!$request->input('old_photo')) {
            $rules = [
                'photo' => "required",
            ];
        }
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("packages.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["type"] = "required";
        $rules["country"] = "required";
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $package->in_country = (boolean)$request->input('in_country');

        $package->embed_video = $request->input('embed_video') ?: null;
        $package->in_home = (boolean)$request->input('in_home');
        $package->days = (int)$request->input('days');
        $package->status = (boolean)$request->input('status');
        $package->adults_count = (int)$request->input('adults_count');
        $package->childrens_count = (int)$request->input('childrens_count');
        $package->babies_count = (int)$request->input('babies_count');
        $package->price = (float)$request->input('price');
        $package->offer_price = (float)$request->input('offer_price');
        $package->season_price = (float)$request->input('season_price');
        $package->country_id = (int)$request->input('country');
        $package->type_id = (int)$request->input('type');
        $package->level = (int)$request->input('stars') ?: 3;

        if ($request->input('photo')) {
            $package->photo = $request->input('photo');
        }


        if ($package->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $package->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $package->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $package->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $package->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
                $package->translateOrNew($locale)->notes = $request->input('notes.' . $locale);
            }

            $days = 0;
            // save hotels and rooms
            if ($request->input('rooms') && is_array($request->input('rooms'))) {

                $rooms = [];
                for ($i = 0; $i < count($request->input("rooms.room")); $i++) {
                    $rooms[] = ['room_id'     => $request->input("rooms.room.$i"),
                                'hotel_id'    => $request->input("rooms.hotel.$i"),
                                'city_id'     => $request->input("rooms.city.$i"),
                                'days'        => $request->input("rooms.days.$i"),
                                'order'       => (int)$request->input("rooms.order.$i"),
                                'rooms_count' => (int)$request->input("rooms.rooms_count.$i")];
                    $days += (int)$request->input("rooms.days.$i") ?: 1;
                }
                $package->rooms()->detach();
                $package->rooms()->sync($rooms);
            } else {
                $package->rooms()->detach();
            }
            $package->days = $days;


            if ($request->input('transports') && is_array($request->input('transports'))) {
                $transports = [];

                for ($i = 0; $i < count($request->input("transports.transport")); $i++) {
                    $transports[] = ['transport_id' => (int)$request->input("transports.transport.$i"),
                                     'city_id'      => (int)$request->input("transports.city.$i"), 'order' => (int)$request->input("transports.order.$i")];

                }
                $package->transports()->detach();
                $package->transports()->sync($transports);
            } else {
                $package->transports()->detach();
            }

            if ($request->input('flights') && is_array($request->input('flights'))) {
                $flights = [];
                for ($i = 0; $i < count($request->input("flights.flight")); $i++) {
                    $flights[] = ['flight_id'       => (int)$request->input("flights.flight.$i"),
                                  'from_country_id' => (int)$request->input("flights.from_country.$i"),
                                  'from_city_id'    => (int)$request->input("flights.from_city.$i"),
                                  'to_country_id'   => (int)$request->input("flights.to_country.$i"),
                                  'to_city_id'      => (int)$request->input("flights.to_city.$i"), 'order' => (int)$request->input("flights.order.$i")];
                }
                $package->flights()->detach();
                $package->flights()->sync($flights);
            } else {
                $package->flights()->detach();
            }


            $package->save();

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
                            'module'    => 'packages',
                            'key'       => 'package-gallery',
                            'module_id' => $package->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }
//        return redirect($this->data['backend_uri'] . "/packages")->with(['message' => trans("packages.success_updated"), 'alert-type' => 'success']);
        return redirect()->back()->with(['message' => trans("packages.success_updated"), 'alert-type' => 'success']);
    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete packages")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $package = Package::find($id);
        if (!$package) {
            return redirect()->back()->with(['message' => trans("packages.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $package->photo;
        $gallery = $package->gallery;

        if ($package->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("packages.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("packages.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete packages")) {
            flash(trans("permissions.permission_denied"), "warning");
            return redirect()->back();
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $package = Package::find($id);

                if ($package) {
                    $defaultPhoto = $package->photo;
                    $gallery = $package->gallery;

                    if ($package->delete()) {
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

            flash(trans("packages.success_multi_delete", ['count' => $deleted]), "success");

            return redirect()->back();
        }
        flash(trans("packages.error_multi_delete_empty"), "danger");

        return redirect()->back();

    }


}
