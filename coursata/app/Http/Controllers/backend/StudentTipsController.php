<?php

namespace Corsata\Http\Controllers\backend;

use Corsata\Category;
use Corsata\StudentTip;
use Corsata\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;
use Corsata\Http\Requests;
use Corsata\Http\Controllers\backend\BackendBaseController;

class StudentTipsController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show student tips")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("Student_tips.backend_page_title");
        $this->data['page_header'] = trans("Student_tips.backend_page_header");
        $this->data['data'] = StudentTip::all();

        return view("backend.student_tips.index", $this->data);
    }

    function category($id = 0)
    {

        if (!Auth::user()->can("show student tips")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->with(['message' => trans("categories.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['category'] = $category;
        $this->data['data'] = $category->Student_tips;

        return view("backend.student_tips.index", $this->data);
    }

    function create()
    {


        if (!Auth::user()->can("create student tips")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("Student_tips.backend_page_title");
        $this->data['page_header'] = trans("Student_tips.backend_page_create_header");
        return view("backend.student_tips.create", $this->data);
    }

    function store(Request $request)
    {

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("Student_tips.validation_name_locale_required", ['locale' => $properties['native']]);
        }
       // $rules["category"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $student_tip = new StudentTip();
        $student_tip->show_type = (int)$request->input('show_type');
        $student_tip->in_home = (boolean)$request->input('in_home');
        $student_tip->status = (boolean)$request->input('status');
        $student_tip->category_id = (int)$request->input('category');

        if ($request->input('photo')) {
            $student_tip->photo = $request->input('photo');
        }


        if ($student_tip->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $student_tip->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $student_tip->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $student_tip->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $student_tip->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $student_tip->save();

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
                            'module'    => 'Student_tips',
                            'key'       => 'StudentTip-gallery',
                            'module_id' => $student_tip->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }

        return redirect($this->data['backend_uri'] . "/student-tips")->with(['message' => trans("Student_tips.success_created"), 'alert-type' => 'success']);
       // return redirect()->back()->with(['message' => trans("Student_tips.success_created"), 'alert-type' => 'success']);


    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit student tips")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $student_tip = StudentTip::find($id);
        if (!$student_tip) {
            flash(trans("Student_tips.id_not_found"), 'danger');

            return redirect()->back();
        }

        $this->data['page_title'] = trans("Student_tips.backend_page_title");
        $this->data['page_header'] = trans("Student_tips.backend_page_create_header");
        $this->data['data'] = $student_tip;

        return view("backend.Student_tips.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit student tips")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $student_tip = StudentTip::find($id);
        if (!$student_tip) {

            return redirect()->back()->with(['message' => trans("Student_tips.id_not_found"), 'alert-type' => 'error']);
        }

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("Student_tips.validation_name_locale_required", ['locale' => $properties['native']]);
        }
       // $rules["category"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $student_tip->show_type = (int)$request->input('show_type');
        $student_tip->in_home = (boolean)$request->input('in_home');
        $student_tip->status = (boolean)$request->input('status');
        $student_tip->category_id = (int)$request->input('category');

        if ($request->input('photo')) {
            $student_tip->photo = $request->input('photo');
        }


        if ($student_tip->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $student_tip->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $student_tip->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $student_tip->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $student_tip->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $student_tip->save();

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
                            'module'    => 'Student_tips',
                            'key'       => 'StudentTip-gallery',
                            'module_id' => $student_tip->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }

         return redirect($this->data['backend_uri'] . "/student-tips")->with(['message' => trans("Student_tips.success_updated"), 'alert-type' => 'success']);
        // return redirect()->back()->with(['message' => trans("Student_tips.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete student tips")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $student_tip = StudentTip::find($id);
        if (!$student_tip) {
            return redirect()->back()->with(['message' => trans("Student_tips.id_not_found"), 'alert-type' => 'error']);
        }

        // get StudentTip photos
        $defaultPhoto = $student_tip->photo;
        $gallery = $student_tip->gallery;

        if ($student_tip->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("Student_tips.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("Student_tips.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete student tips")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $student_tip = StudentTip::find($id);

                if ($student_tip) {
                    $defaultPhoto = $student_tip->photo;
                    $gallery = $student_tip->gallery;

                    if ($student_tip->delete()) {
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

            return redirect()->back()->with(["message" => trans("Student_tips.success_multi_delete", ['count' => $deleted]), "alert-type" => "success"]);
        }

        return redirect()->back()->with(["message" => trans("Student_tips.error_multi_delete_empty"), "alert-type" => "error"]);

    }


}
