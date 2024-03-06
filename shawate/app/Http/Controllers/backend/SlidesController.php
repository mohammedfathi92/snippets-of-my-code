<?php

namespace App\Http\Controllers\backend;

use App\Category;
use App\Slide;
use App\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\backend\BackendBaseController;

class SlidesController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show slides")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("slides.backend_page_title");
        $this->data['page_header'] = trans("slides.backend_page_header");

        return view("backend.slides.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create slides")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("slides.backend_page_title");
        $this->data['page_header'] = trans("slides.backend_page_create_header");
        return view("backend.slides.create", $this->data);
    }

    function store(Request $request)
    {

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $messages["name.$locale.required"] = trans("slides.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["photo"] = "required";
        $rules["url"] = "url";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $slides = new Slide();
        $slides->url = $request->input('url') ?: "#";
        $slides->sort = (integer)$request->input('sort');
        $slides->status = (boolean)$request->input('status');

        if ($request->input('photo')) {
            $slides->photo = $request->input('photo');
        }


        if ($slides->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $slides->translateOrNew($locale)->name = $request->input('name.' . $locale);
            }

            $slides->save();

        }

        return redirect($this->data['backend_uri'] . "/slides")->with(['message' => trans("slides.success_created"), 'alert-type' => 'success']);


    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit slides")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $slides = Slide::find($id);
        if (!$slides) {
            return redirect()->back()->with(['message' => trans("slides.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("slides.backend_page_title");
        $this->data['page_header'] = trans("slides.backend_page_create_header");
        $this->data['data'] = $slides;

        return view("backend.slides.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit slides")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $slides = Slide::find($id);
        if (!$slides) {

            return redirect()->back()->with(['message' => trans("slides.id_not_found"), 'alert-type' => 'error']);
        }

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $messages["name.$locale.required"] = trans("slides.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["photo"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $slides->url = $request->input('url') ?: "#";
        $slides->sort = (integer)$request->input('sort');
        $slides->status = (boolean)$request->input('status');

        if ($request->input('photo')) {
            $slides->photo = $request->input('photo');
        }


        if ($slides->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $slides->translateOrNew($locale)->name = $request->input('name.' . $locale);
            }

            $slides->save();

        }

        return redirect($this->data['backend_uri'] . "/slides")->with(['message' => trans("slides.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete slides")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $slides = Slide::find($id);
        if (!$slides) {
            return redirect()->back()->with(['message' => trans("slides.id_not_found"), 'alert-type' => 'error']);
        }

        // get Slide photos
        $defaultPhoto = $slides->photo;

        if ($slides->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);

            return redirect()->back()->with(['message' => trans("slides.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("slides.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete slides")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $slides = Slide::find($id);

                if ($slides) {
                    $defaultPhoto = $slides->photo;

                    if ($slides->delete()) {
                        $uploader = new UploaderController();
                        $uploader->delete($defaultPhoto);
                        $deleted++;
                    }


                }
            }

            return redirect()->back()->with(["message" => trans("slides.success_multi_delete", ['count' => $deleted]), "alert-type" => "success"]);
        }

        return redirect()->back()->with(["message" => trans("slides.error_multi_delete_empty"), "alert-type" => "error"]);

    }


}
