<?php

namespace Corsata\Http\Controllers\backend;

use Corsata\Country;
use Corsata\Institute;
use Corsata\Course;
use Corsata\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use Corsata\Http\Requests;
use Corsata\Http\Controllers\backend\BackendBaseController;

class CoursesController extends BackendBaseController
{
    function index($institute_id = 0)
    {

        if (!Auth::user()->can("show courses")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $institute = Institute::find($institute_id);
        if (!$institute)
            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);

        $this->data['institute'] = $institute;
        $this->data['data'] = $institute->courses;

        return view("backend.courses.index", $this->data);
    }

    function create($institute_id = 0)
    {
        if (!Auth::user()->can("create courses")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $institute = Institute::find($institute_id);
        if (!$institute)
            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);

        $this->data['institute'] = $institute;
        $this->data['title'] = trans("courses.backend_page_create_header");

        return view("backend.courses.create", $this->data);
    }

    function store(Request $request, $institute_id = 0)
    {
        if (!Auth::user()->can("create courses")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $institute = Institute::find($institute_id);
        if (!$institute)
            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);

        $rules = [
            'photo' => "required",
            'category' => "required",
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("courses.validation_name_locale_required", ['locale' => $properties['native']]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $course = new Course();
        $course->photo = (boolean)$request->input('photo') ?: null;
        $course->video_youtube = $request->input('video_youtube') ?: null;
        $course->price = (double)$request->input('price') ?: null;
        $course->offer_price = (double)$request->input('offer_price') ?: null;
        $course->avg_students = (int)$request->input('avg_students') ?: null;
        $course->max_students = (int)$request->input('max_students') ?: null;
        $course->min_age = (int)$request->input('min_age') ?: null;
        $course->start_day = $request->input("start_day") ?: "Mo";
        $course->category_id = (int)$request->input("category");
        $course->institute_id = $institute->id;
        $course->currency_id = (int)$request->input("currency");
        $course->hours = (int)$request->input("hours") ?: 1;
        $course->num_lessons = (int)$request->input("lessons") ?: 1;
        $course->locale_rate = (int)$request->input("locale_rate") ?: 1;
        $course->international_rate = (int)$request->input("international_rate") ?: 1;
        $course->in_home = (boolean)$request->input("in_home");
        $course->featured = (boolean)$request->input("featured");

        if ($request->input('photo')) {
            $course->photo = $request->input('photo');
        }


        if ($course->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $course->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $course->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $course->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $course->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
                $course->translateOrNew($locale)->notes = $request->input('notes.' . $locale);
            }

            $course->save();

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
                            'module'    => 'courses',
                            'key'       => 'course-gallery',
                            'module_id' => $course->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
            if ($request->input("services") && is_array($request->input('services'))) {
                $course->services()->sync($request->input('services'));
            }
        }

        return redirect($this->data['backend_uri'] . "/institutes/$institute_id/courses")->with(['message' => trans("courses.success_created"), 'alert-type' => 'success']);


    }


    function edit($institute_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit courses")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $institute = Institute::find($institute_id);
        if (!$institute) {
            return redirect()->back()->with(['message' => trans("institutes.id_not_found"), 'alert-type' => 'error']);
        }
        $course = Course::find($id);
        if (!$course) {
            return redirect()->back()->with(['message' => trans("courses.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("courses.backend_page_title");
        $this->data['page_header'] = trans("courses.backend_page_create_header");
        $this->data['institute'] = $institute;
        $this->data['data'] = $course;

        return view("backend.courses.edit", $this->data);
    }

    function update(Request $request, $institute_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit courses")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $institute = Institute::find($institute_id);
        if (!$institute) {

            return redirect()->back()->with(['message' => trans("institutes.id_not_found"), 'alert-type' => 'error']);
        }
        $course = $institute->courses()->find($id);
        if (!$course) {

            return redirect()->back()->with(['message' => trans("courses.id_not_found"), 'alert-type' => 'error']);
        }

        $rules = [
            'photo' => "required",
            'category' => "required",
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("courses.validation_name_locale_required", ['locale' => $properties['native']]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $course->photo = (boolean)$request->input('photo') ?: null;
        $course->video_youtube = $request->input('video_youtube') ?: null;
        $course->price = (double)$request->input('price') ?: null;
        $course->offer_price = (double)$request->input('offer_price') ?: null;
        $course->avg_students = (int)$request->input('avg_students') ?: null;
        $course->max_students = (int)$request->input('max_students') ?: null;
        $course->min_age = (int)$request->input('min_age') ?: null;
        $course->start_day = $request->input("start_day") ?: "Mo";
        $course->category_id = (int)$request->input("category");
        $course->currency_id = (int)$request->input("currency");
        $course->institute_id = $institute->id;
        $course->hours = (int)$request->input("hours") ?: 1;
        $course->num_lessons = (int)$request->input("lessons") ?: 1;
        $course->locale_rate = (int)$request->input("locale_rate") ?: 1;
        $course->international_rate = (int)$request->input("international_rate") ?: 1;
        $course->in_home = (boolean)$request->input("in_home");
        $course->featured = (boolean)$request->input("featured");

        if ($request->input('photo')) {
            $course->photo = $request->input('photo');
        }


        if ($course->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $course->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $course->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $course->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $course->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
                $course->translateOrNew($locale)->notes = $request->input('notes.' . $locale);
            }

            $course->save();

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
                            'module'    => 'courses',
                            'key'       => 'course-gallery',
                            'module_id' => $course->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
            if ($request->input("services") && is_array($request->input('services'))) {
                $course->services()->sync($request->input('services'));
            }
        }

        return redirect($this->data['backend_uri'] . "/institutes/$institute_id/courses")->with(['message' => trans("courses.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $institute_id = 0, $id = 0)
    {
        if (!Auth::user()->can("delete courses")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $institute = Institute::find($institute_id);
        if (!$institute) {
            return redirect()->back()->with(['message' => trans("institutes.id_not_found"), 'alert-type' => 'error']);
        }
        $course = Course::find($id);
        if (!$course) {
            return redirect()->back()->with(['message' => trans("courses.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $course->photo;
        $gallery = $course->gallery;

        if ($course->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("courses.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("courses.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request, $institute_id = 0)
    {
        if (!Auth::user()->can("delete courses")) {
            flash(trans("permissions.permission_denied"), "warning");
            return redirect()->back();
        }
        $institute = Institute::find($institute_id);
        if (!$institute) {
            return redirect()->back()->with(['message' => trans("institutes.id_not_found"), 'alert-type' => 'error']);
        }
        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $course = Course::find($id);

                if ($course) {
                    $defaultPhoto = $course->photo;
                    $gallery = $course->gallery;

                    if ($course->delete()) {
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

            flash(trans("courses.success_multi_delete", ['count' => $deleted]), "success");

            return redirect()->back();
        }
        flash(trans("courses.error_multi_delete_empty"), "danger");

        return redirect()->back();

    }


}
