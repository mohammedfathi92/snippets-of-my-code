<?php

namespace Corsata\Http\Controllers\backend;

use Corsata\Institute;
use Corsata\BasicService;
use Corsata\Service;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use Corsata\Http\Requests;

//use Corsata\Http\Controllers\backend\BackendBaseController;

class ServicesController extends BackendBaseController
{
    function index($institute_id = 0)
    {

        if (!Auth::user()->can("show services")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $institute = Institute::find($institute_id);
        if (!$institute) {

            return redirect()->back()->with(['message' => trans("institutes.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['title'] = trans("services.backend_page_title");
        $this->data['institute'] = $institute;
        $this->data['services'] = $institute->services()->get();
        $this->data['method'] = "post";
        return view("backend.services.index", $this->data);
    }

    function create($institute_id = 0)
    {
        if (!Auth::user()->can("create services")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $institute = Institute::find($institute_id);
        if (!$institute) {

            return redirect()->back()->with(['message' => trans("institutes.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("services.backend_page_title");
        $this->data['page_header'] = trans("services.backend_page_create_header");
        $this->data['method'] = 'post';
        $this->data['institute'] = $institute;
        $this->data['services'] = $institute->services()->get();
        return view("backend.services.index", $this->data);
    }

    function store(Request $request, $institute_id = 0)
    {
        $institute = Institute::find($institute_id);
        if (!$institute) {

            return redirect()->back()->with(['message' => trans("institutes.id_not_found"), 'alert-type' => 'error']);
        }

        $rules = [
            'type'       => "required",
            'house_type' => "required_if:type,house",
        ];
        $messages = [];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $messages["name.$locale.required"] = trans("services.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $service = new Service();
        $service->photo = $request->input('photo') ?: null;
        $service->price = (double)$request->input('price') ?: (0.0);
        $service->fees = (double)$request->input('fees') ?: (0.0);
        $service->type = $request->input('type') ?: null;
        $service->house_type = $request->input('house_type') ?: null;
        $service->min_age = (int)$request->input('min_age') ?: null;
        $service->institute_id = $institute->id;
        $service->sort = (int)$request->input('sort') ?: 1;
        if ($service->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $service->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $service->translateOrNew($locale)->meals = $request->input('meals.' . $locale);
                $service->translateOrNew($locale)->room_type = $request->input('room_type.' . $locale);
                $service->translateOrNew($locale)->transport_type = $request->input('transport_type.' . $locale);
                $service->translateOrNew($locale)->description = $request->input('description.' . $locale);
            }
            $service->save();

        }

        return redirect($this->data['backend_uri'] . "/institutes/$institute_id/services")->with(['message' => trans("services.success_created"), 'alert-type' => 'success']);


    }

    function addBasicServices(Request $request, $institute_id = 0)
    {
        $institute = Institute::find($institute_id);
        if (!$institute) {

            return redirect()->back()->with(['message' => trans("institutes.id_not_found"), 'alert-type' => 'error']);
        }

        $services_ids = $request->input("basic_services",[]);
       

        foreach (BasicService::whereIn('id', $services_ids)->get() as $basicService) {
            

        $service = new Service();
        $service->photo = $basicService->photo;
        $service->price = $basicService->price;
        $service->fees = $basicService->fees;
        $service->type = $basicService->type;
        $service->house_type = $basicService->house_type;
        $service->min_age = $basicService->min_age;
        $service->institute_id = $institute_id;
        $service->sort = $basicService->sort;
        if ($service->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $service->translateOrNew($locale)->name = $basicService->{"name:".$locale};
                $service->translateOrNew($locale)->meals = $basicService->{"meals:".$locale};
                $service->translateOrNew($locale)->room_type = $basicService->{"room_type:".$locale};
                $service->translateOrNew($locale)->transport_type = $basicService->{"transport_type:".$locale};
                $service->translateOrNew($locale)->description = $basicService->{"description:".$locale};
            }
            $service->save();

        }
    }

        return redirect($this->data['backend_uri'] . "/institutes/$institute_id/services")->with(['message' => trans("services.success_created"), 'alert-type' => 'success']);


    }


    function edit($institute_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit services")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $institute = Institute::find($institute_id);
        if (!$institute) {

            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);
        }

        $service = $institute->services()->find($id);
        if (!$service) {

            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("services.backend_page_title");
        $this->data['page_header'] = trans("services.backend_page_create_header");
        $this->data['data'] = $service;
        $this->data['institute'] = $institute;
        $this->data['services'] = $institute->services()->get();
        $this->data['method'] = 'put';

        // dd($this->data['data']);

        return view("backend.services.index", $this->data);
    }

    function update(Request $request, $institute_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit services")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'warning']);
        }

        $institute = Institute::find($institute_id);
        if (!$institute) {

            return redirect()->back()->with(['message' => trans("institutes.id_not_found"), 'alert-type' => 'error']);
        }

        $service = Service::find($id);
        if (!$service) {
            return redirect()->back()->with(['message' => trans("services.id_not_found"), 'alert-type' => 'error']);
        }

        $rules = [
            'type'       => "required",
            'house_type' => "required_if:type,house",
        ];

        $messages = [];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $messages["name.$locale.required"] = trans("services.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $service->photo = $request->input('photo') ?: null;
        $service->price = (double)$request->input('price') ?: (0.0);
        $service->fees = (double)$request->input('fees') ?: (0.0);
        $service->type = $request->input('type') ?: null;
        $service->house_type = $request->input('house_type') ?: null;
        $service->min_age = (int)$request->input('min_age') ?: null;
        $service->institute_id = $institute->id;
        $service->sort = (int)$request->input('sort') ?: 1;
        if ($service->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $service->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $service->translateOrNew($locale)->meals = $request->input('meals.' . $locale);
                $service->translateOrNew($locale)->room_type = $request->input('room_type.' . $locale);
                $service->translateOrNew($locale)->transport_type = $request->input('transport_type.' . $locale);
                $service->translateOrNew($locale)->description = $request->input('description.' . $locale);
            }
            $service->save();

        }
        return redirect($this->data['backend_uri'] . "/institutes/$institute_id/services")
            ->with(['message' => trans("services.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $institute_id = 0, $id = 0)
    {

        if (!Auth::user()->can("delete services")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $service = Service::find($id);
        if (!$service) {
            return redirect("/" . $this->data['backend_uri'] . "/institutes/services")->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);
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

            return redirect("/" . $this->data['backend_uri'] . "/institutes/services")->with(['message' => trans("services.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect("/" . $this->data['backend_uri'] . "/institutes/services")->with(['message' => trans("services.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete services")) {
            flash(trans("permissions.permission_denied"), "warning");
            return redirect()->back();
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $service = Service::find($id);

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

            flash(trans("services.success_multi_delete", ['count' => $deleted]), "success");

            return redirect()->back();
        }
        flash(trans("services.error_multi_delete_empty"), "danger");

        return redirect()->back();

    }


}
