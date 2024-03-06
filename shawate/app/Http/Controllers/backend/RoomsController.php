<?php

namespace App\Http\Controllers\backend;

use App\Country;
use App\Hotel;
use App\Room;
use App\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\backend\BackendBaseController;

class RoomsController extends BackendBaseController
{
    function index($hotel_id = 0)
    {

        if (!Auth::user()->can("show rooms")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $hotel = Hotel::find($hotel_id);
        if (!$hotel)
            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);

        $this->data['hotel'] = $hotel;
        $this->data['data'] = $hotel->rooms;

        return view("backend.rooms.index", $this->data);
    }

    function create($hotel_id = 0)
    {
        if (!Auth::user()->can("create rooms")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $hotel = Hotel::find($hotel_id);
        if (!$hotel)
            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);

        $this->data['hotel'] = $hotel;

        return view("backend.rooms.create", $this->data);
    }

    function store(Request $request, $hotel_id = 0)
    {
        if (!Auth::user()->can("create rooms")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $hotel = Hotel::find($hotel_id);
        if (!$hotel)
            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);

        $rules = [
            'photo'   => "required",
            'persons' => "required|min:1|max:15|numeric",
            'beds'    => "required|min:1|max:10|numeric",
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("rooms.validation_name_locale_required", ['locale' => $properties['native']]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $room = new Room();
        $room->status = (boolean)$request->input('status');
        $room->embed_video = $request->input('embed_video') ?: null;
        $room->price = (float)$request->input('price');
        $room->offer_price = (float)$request->input('offer_price');
        $room->season_price = (float)$request->input('season_price');
        $room->hotel_id = $hotel_id;
        $room->persons = (int)$request->input("persons") ?: 1;
        $room->beds = (int)$request->input("beds") ?: 1;
        if ($request->input('photo')) {
            $room->photo = $request->input('photo');
        }


        if ($room->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $room->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $room->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $room->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $room->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
                $room->translateOrNew($locale)->notes = $request->input('notes.' . $locale);
            }

            $room->save();

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
                            'module'    => 'rooms',
                            'key'       => 'room-gallery',
                            'module_id' => $room->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
            if ($request->input("services") && is_array($request->input('services'))) {
                $room->services()->sync($request->input('services'));
            }
        }

        return redirect($this->data['backend_uri'] . "/hotels/$hotel_id/rooms")->with(['message' => trans("rooms.success_created"), 'alert-type' => 'success']);


    }


    function edit($hotel_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit rooms")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $hotel = Hotel::find($hotel_id);
        if (!$hotel) {
            return redirect()->back()->with(['message' => trans("hotels.id_not_found"), 'alert-type' => 'error']);
        }
        $room = Room::find($id);
        if (!$room) {
            return redirect()->back()->with(['message' => trans("rooms.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("rooms.backend_page_title");
        $this->data['page_header'] = trans("rooms.backend_page_create_header");
        $this->data['data'] = $room;
        $this->data['countries'] = Country::all();

        return view("backend.rooms.edit", $this->data);
    }

    function update(Request $request, $hotel_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit rooms")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $hotel = Hotel::find($hotel_id);
        if (!$hotel) {

            return redirect()->back()->with(['message' => trans("hotels.id_not_found"), 'alert-type' => 'error']);
        }
        $room = $hotel->rooms()->where('id', $id)->first();
        if (!$room) {

            return redirect()->back()->with(['message' => trans("rooms.id_not_found"), 'alert-type' => 'error']);
        }

        $rules = [
            'photo' => "required",
            'persons' => "required|min:1|max:15|numeric",
            'beds'    => "required|min:1|max:10|numeric",
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("rooms.validation_name_locale_required", ['locale' => $properties['native']]);
        }


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $room->status = (boolean)$request->input('status');
        $room->embed_video = $request->input('embed_video') ?: null;
        $room->price = (float)$request->input('price');
        $room->offer_price = (float)$request->input('offer_price');
        $room->season_price = (float)$request->input('season_price');
        $room->hotel_id = $hotel_id;
        $room->persons = (int)$request->input("persons") ?: 1;
        $room->beds = (int)$request->input("beds") ?: 1;

        if ($request->input('photo')) {
            $room->photo = $request->input('photo');
        }


        if ($room->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $room->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $room->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $room->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $room->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
                $room->translateOrNew($locale)->notes = $request->input('notes.' . $locale);
            }

            $room->save();

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
                            'module'    => 'rooms',
                            'key'       => 'room-gallery',
                            'module_id' => $room->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
            if ($request->input("services") && is_array($request->input('services'))) {
                $room->services()->sync($request->input('services'));
            }
        }

        return redirect($this->data['backend_uri'] . "/hotels/$hotel_id/rooms")->with(['message' => trans("rooms.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $hotel_id = 0, $id = 0)
    {
        if (!Auth::user()->can("delete rooms")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $hotel = Hotel::find($hotel_id);
        if (!$hotel) {
            return redirect()->back()->with(['message' => trans("hotels.id_not_found"), 'alert-type' => 'error']);
        }
        $room = $hotel->rooms()->where('id', $id)->first();
        if (!$room) {
            return redirect()->back()->with(['message' => trans("rooms.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $room->photo;
        $gallery = $room->gallery;

        if ($room->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("rooms.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("rooms.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request, $hotel_id = 0)
    {
        if (!Auth::user()->can("delete rooms")) {
            flash(trans("permissions.permission_denied"), "warning");
            return redirect()->back();
        }
        $hotel = Hotel::find($hotel_id);
        if (!$hotel) {
            return redirect()->back()->with(['message' => trans("hotels.id_not_found"), 'alert-type' => 'error']);
        }
        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $room = Room::find($id);

                if ($room) {
                    $defaultPhoto = $room->photo;
                    $gallery = $room->gallery;

                    if ($room->delete()) {
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

            flash(trans("rooms.success_multi_delete", ['count' => $deleted]), "success");

            return redirect()->back();
        }
        flash(trans("rooms.error_multi_delete_empty"), "danger");

        return redirect()->back();

    }


}
