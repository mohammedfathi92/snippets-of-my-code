<?php

namespace App\Http\Controllers\backend;

use App\Category;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\backend\BackendBaseController;

class CategoriesController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show categories")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("categories.backend_page_title");
        $this->data['page_header'] = trans("categories.backend_page_header");
        $this->data['data'] = Category::all();

        return view("backend.categories.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create categories")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("categories.backend_page_title");
        $this->data['page_header'] = trans("categories.backend_page_create_header");

        return view("backend.categories.create", $this->data);
    }

    function store(Request $request)
    {
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("categories.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["country"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = new Category();
        $category->in_home = (boolean)$request->input('in_home');
        $category->status = (boolean)$request->input('status');
        $category->country_id = (int)$request->input('country');
        $category->city_id = (int)$request->input('city') ?: null;
        $category->parent_id = (int)$request->input('parent') ?: 0;

        if ($request->input('photo')) {
            $category->photo = $request->input('photo');
        }


        if ($category->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $category->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $category->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $category->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $category->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $category->save();

        }

        return redirect($this->data['backend_uri'] . "/categories")->with(['message' => trans("categories.success_created"), 'alert-type' => 'success']);


    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit categories")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $category = Category::find($id);
        if (!$category) {
            flash(trans("categories.id_not_found"), 'danger');

            return redirect()->back();
        }

        $this->data['page_title'] = trans("categories.backend_page_title");
        $this->data['page_header'] = trans("categories.backend_page_create_header");
        $this->data['data'] = $category;

        return view("backend.categories.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit categories")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $category = Category::find($id);
        if (!$category) {

            return redirect()->back()->with(['message' => trans("categories.id_not_found"), 'alert-type' => 'error']);
        }

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("categories.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["country"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $category->in_home = (boolean)$request->input('in_home');
        $category->status = (boolean)$request->input('status');
        $category->country_id = (int)$request->input('country');
        $category->city_id = (int)$request->input('city') ?: null;
        $category->parent_id = (int)$request->input('parent') ?: 0;

        if ($request->input('photo')) {
            $category->photo = $request->input('photo');
        }


        if ($category->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $category->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $category->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $category->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $category->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $category->save();

        }

        return redirect($this->data['backend_uri'] . "/categories")->with(['message' => trans("categories.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete categories")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->with(['message' => trans("categories.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $category->photo;


        if ($category->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);

            return redirect()->back()->with(['message' => trans("categories.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("categories.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete categories")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $category = Category::find($id);

                if ($category) {
                    $defaultPhoto = $category->photo;

                    if ($category->delete()) {
                        $uploader = new UploaderController();
                        $uploader->delete($defaultPhoto);
                        $deleted++;
                    }


                }
            }

            return redirect()->back()->with(["message" => trans("categories.success_multi_delete", ['count' => $deleted]), "alert-type" => "success"]);
        }

        return redirect()->back()->with(["message" => trans("categories.error_multi_delete_empty"), "alert-type" => "error"]);

    }


}
