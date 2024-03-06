<?php

namespace App\Http\Controllers\backend;

use App\Country;
use App\PackageType;
use App\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\backend\BackendBaseController;

class PackagesTypesController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show packages types")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("packages_types.backend_page_title");
        $this->data['page_header'] = trans("packages_types.backend_page_header");
        $this->data['data'] = PackageType::all();

        return view("backend.packages_types.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create packages types")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("packages_types.backend_page_title");
        $this->data['page_header'] = trans("packages_types.backend_page_create_header");
        $this->data['countries'] = Country::all();

        return view("backend.packages_types.create", $this->data);
    }

    function store(Request $request)
    {

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("packages_types.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["country"] = "required";
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $packageType = new PackageType();
        $packageType->status = (boolean)$request->input('status');
        $packageType->country_id = (int)$request->input('country');


        if ($packageType->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $packageType->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $packageType->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $packageType->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $packageType->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
                $packageType->translateOrNew($locale)->notes = $request->input('notes.' . $locale);
            }

            $packageType->save();

        }

        return redirect($this->data['backend_uri'] . "/packages_types")->with(['message' => trans("packages_types.success_created"), 'alert-type' => 'success']);


    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit packages types")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $packageType = PackageType::find($id);
        if (!$packageType) {
            return redirect()->back()->with(['message' => trans("packages_types.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("packages_types.backend_page_title");
        $this->data['page_header'] = trans("packages_types.backend_page_create_header");
        $this->data['data'] = $packageType;
        $this->data['countries'] = Country::all();

        return view("backend.packages_types.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit packages types")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $packageType = PackageType::find($id);
        if (!$packageType) {

            return redirect()->back()->with(['message' => trans("packages_types.id_not_found"), 'alert-type' => 'error']);
        }

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("packages_types.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["country"] = "required";
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $packageType->status = (boolean)$request->input('status');
        $packageType->country_id = (int)$request->input('country');


        if ($packageType->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $packageType->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $packageType->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $packageType->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $packageType->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
                $packageType->translateOrNew($locale)->notes = $request->input('notes.' . $locale);
            }

            $packageType->save();

        }

        return redirect($this->data['backend_uri'] . "/packages_types")->with(['message' => trans("packages_types.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete packages types")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $packageType = PackageType::find($id);
        if (!$packageType) {
            return redirect()->back()->with(['message' => trans("packages_types.id_not_found"), 'alert-type' => 'error']);
        }

        if ($packageType->delete()) {

            return redirect()->back()->with(['message' => trans("packages_types.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("packages_types.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete packages types")) {
            flash(trans("permissions.permission_denied"), "warning");
            return redirect()->back();
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $packageType = PackageType::find($id);

                if ($packageType) {

                    if ($packageType->delete()) {
                        $deleted++;
                    }


                }
            }

            return redirect()->back()->with(['message' => trans("packages_types.success_multi_delete", ['count' => $deleted]), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("packages_types.error_multi_delete_empty"), 'alert-type' => 'error']);;

    }


}
