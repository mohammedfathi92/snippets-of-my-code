<?php

namespace Corsata\Http\Controllers\backend;

use Corsata\CourseService;
use Corsata\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use Corsata\Http\Requests;

//use Corsata\Http\Controllers\backend\BackendBaseController;

class CoursesServicesController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show courses services")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("courses_services.backend_page_title");
        $this->data['page_header'] = trans("courses_services.backend_page_header");
        $this->data['allServices'] = CourseService::all();
        $this->data['method'] = "post";

        return view("backend.courses_services.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create services")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("courses_services.backend_page_title");
        $this->data['page_header'] = trans("courses_services.backend_page_create_header");

        return view("backend.courses_services.create", $this->data);
    }

    function store(Request $request)
    {
        $rules = [];
        $messages = [];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $messages["name.$locale.required"] = trans("courses_services.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $service = new CourseService();
        $service->icon_class = $request->input('icon');
        $service->sort = (int)$request->input('sort') ?: 1;
        if ($service->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $service->translateOrNew($locale)->name = $request->input('name.' . $locale);
            }
            $service->save();

        }

        return redirect($this->data['backend_uri'] . "/institutes/courses/services")->with(['message' => trans("courses_services.success_created"), 'alert-type' => 'success']);

    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit courses services")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $service = CourseService::find($id);
        if (!$service) {

            return redirect()->back()->with(['message' => trans("courses_services.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("services.backend_page_title");
        $this->data['page_header'] = trans("services.backend_page_create_header");
        $this->data['data'] = $service;
        $this->data['method'] = 'put';

        return view("backend.courses_services.index", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit courses services")) {
            flash(trans("permissions.permission_denied"), "warning");
            return redirect()->back();
        }
        $rules = [];
        $messages = [];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $messages["name.$locale.required"] = trans("institutes.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $service = CourseService::find($id);
        $service->icon_class = $request->input('icon');
        $service->sort = (int)$request->input('sort') ?: 1;
        if ($service->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $service->translateOrNew($locale)->name = $request->input('name.' . $locale);
            }
            $service->save();

        }
        return redirect($this->data['backend_uri'] . "/institutes/courses/services")
            ->with(['message' => trans("courses_services.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete courses services")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $service = CourseService::find($id);
        if (!$service) {
            return redirect("/" . $this->data['backend_uri'] . "/institutes/courses/services")->with(['message' => trans("courses_services.id_not_found"), 'alert-type' => 'error']);
        }

        // get service photos
        $defaultPhoto = $service->flag;
        $gallery = $service->gallery;

        if ($service->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect("/" . $this->data['backend_uri'] . "/institutes/courses/services")->with(['message' => trans("courses_services.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect("/" . $this->data['backend_uri'] . "/institutes/courses/services")->with(['message' => trans("courses_services.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete courses services")) {
            flash(trans("permissions.permission_denied"), "warning");
            return redirect()->back();
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $service = CourseService::find($id);

                if ($service) {
                    $defaultPhoto = $service->flag;
                    $gallery = $service->gallery;

                    if ($service->delete()) {
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

            flash(trans("courses_services.success_multi_delete", ['count' => $deleted]), "success");

            return redirect()->back();
        }
        flash(trans("courses_services.error_multi_delete_empty"), "danger");

        return redirect()->back();

    }


}
