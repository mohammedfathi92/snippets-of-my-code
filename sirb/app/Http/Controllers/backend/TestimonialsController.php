<?php

namespace Sirb\Http\Controllers\backend;

use Sirb\Country;
use Sirb\Testimonial;
use Sirb\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use Sirb\Http\Requests;
use Sirb\Http\Controllers\backend\BackendBaseController;

class TestimonialsController extends BackendBaseController
{
    function index()
    {
        if (!Auth::user()->can("show testimonials")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['data'] = Testimonial::all();

        return view("backend.testimonials.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create testimonials")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("testimonials.backend_page_title");
        $this->data['page_header'] = trans("testimonials.backend_page_create_header");
        $this->data['countries'] = Country::all();

        return view("backend.testimonials.create", $this->data);
    }

    function store(Request $request)
    {
        $defaultLocale = config("app.locale");
        $rules = [];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["title.$locale"] = "max:255";
            $rules["visitor_name.$locale"] = "max:255";
            $rules["nationality.$locale"] = "max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["title.$locale.required"] = trans("testimonials.validation_title_locale_required", ['locale' => $properties['native']]);
        }
        $rules["title.$defaultLocale"] = "required";
        $rules["visitor_name.$defaultLocale"] = "required";
        $rules["nationality.$defaultLocale"] = "required";
        $rules["video_url"] = "required_if:type,video";
        $rules["country"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $testimonial = new Testimonial();

        $testimonial->in_home = (boolean)$request->input('in_home');
        $testimonial->status = (boolean)$request->input('status');
        $testimonial->email = $request->input('email')?:null;
        $testimonial->type = $request->input('type') == "video" ?: "text";
        $testimonial->trip_type = $request->input('trip_type') ?: 1;
        $testimonial->video_url = $request->input('video_url') ?: null;
        $testimonial->country_id = (int)$request->input('country');

        if ($request->input('avatar')) {
            $testimonial->avatar = $request->input('avatar');
        }

        if ($testimonial->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $testimonial->translateOrNew($locale)->title = $request->input('title.' . $locale) ?: $request->input('title.' . $defaultLocale);
                $testimonial->translateOrNew($locale)->visitor_name = $request->input('visitor_name.' . $locale) ?: $request->input('visitor_name.' . $defaultLocale);
                $testimonial->translateOrNew($locale)->nationality = $request->input('nationality.' . $locale) ?: $request->input('nationality.' . $defaultLocale);
                $testimonial->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $testimonial->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $testimonial->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $testimonial->save();

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
                            'module'    => 'testimonials',
                            'key'       => 'testimonial-gallery',
                            'module_id' => $testimonial->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }

        }

//        return redirect($this->data['backend_uri'] . "/testimonials")->with(['message' => trans("testimonials.success_created"), 'alert-type' => 'success']);
        return redirect()->back()->with(['message' => trans("testimonials.success_created"), 'alert-type' => 'success']);


    }

    function edit($id = 0)
    {
        if (!Auth::user()->can("edit testimonials")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return redirect()->back()->with(['message' => trans("testimonials.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("testimonials.backend_page_title");
        $this->data['page_header'] = trans("testimonials.backend_page_create_header");
        $this->data['data'] = $testimonial;
        $this->data['countries'] = Country::all();

        return view("backend.testimonials.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit testimonials")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $testimonial = Testimonial::find($id);
        if (!$testimonial) {

            return redirect()->back()->with(['message' => trans("testimonials.id_not_found"), 'alert-type' => 'error']);
        }

        $defaultLocale = config("app.locale");
        $rules = [];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["title.$locale"] = "max:255";
            $rules["visitor_name.$locale"] = "max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["title.$locale.required"] = trans("testimonials.validation_title_locale_required", ['locale' => $properties['native']]);
        }
        $rules["title.$defaultLocale"] = "required";
        $rules["visitor_name.$defaultLocale"] = "required";
        $rules["video_url"] = "required_if:type,video";
        $rules["country"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $testimonial->in_home = (boolean)$request->input('in_home');
        $testimonial->status = (boolean)$request->input('status');
        $testimonial->type = $request->input('type') == "video" ?: "text";
        $testimonial->trip_type = $request->input('trip_type') ?: 1;
        $testimonial->video_url = $request->input('video_url') ?: null;
        $testimonial->country_id = (int)$request->input('country');

        if ($request->input('avatar')) {
            $testimonial->avatar = $request->input('avatar');
        }

        if ($testimonial->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $testimonial->translateOrNew($locale)->title = $request->input('title.' . $locale) ?: $request->input('title.' . $defaultLocale);
                $testimonial->translateOrNew($locale)->visitor_name = $request->input('visitor_name.' . $locale) ?: $request->input('visitor_name.' . $defaultLocale);
                $testimonial->translateOrNew($locale)->nationality = $request->input('nationality.' . $locale) ?: $request->input('nationality.' . $defaultLocale);
                $testimonial->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $testimonial->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $testimonial->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $testimonial->save();

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
                            'module'    => 'testimonials',
                            'key'       => 'testimonial-gallery',
                            'module_id' => $testimonial->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }

        }

//        return redirect($this->data['backend_uri'] . "/testimonials")->with(['message' => trans("testimonials.success_updated"), 'alert-type' => 'success']);
        return redirect()->back()->with(['message' => trans("testimonials.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete testimonials")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return redirect()->back()->with(['message' => trans("testimonials.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $testimonial->photo;
        $gallery = $testimonial->gallery;

        if ($testimonial->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("testimonials.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("testimonials.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete testimonials")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $testimonial = Testimonial::find($id);

                if ($testimonial) {
                    $defaultPhoto = $testimonial->photo;
                    $gallery = $testimonial->gallery;

                    if ($testimonial->delete()) {
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

            return redirect()->back()->with(['message' => trans("testimonials.success_multi_delete", ['count' => $deleted]), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("testimonials.error_multi_delete_empty"), 'alert-type' => 'warning']);

    }


}
