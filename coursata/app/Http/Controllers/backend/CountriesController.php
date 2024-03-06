<?php

namespace Corsata\Http\Controllers\backend;

use Corsata\Country;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use Corsata\Http\Requests;
use Corsata\Http\Controllers\backend\BackendBaseController;

class CountriesController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show countries")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['title'] = trans("countries.backend_page_header");
        $this->data['data'] = Country::all();

        return view("backend.countries.index", $this->data);
    }

    function members($id = 0)
    {
        $country = Country::find($id);
        if (!$country) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['title'] = trans("countries.backend_country_members_page_header", ["name" => $country->name]);
        $this->data['country'] = $country;
        $this->data['data'] = $country->users()->paginate(config("settings.backend_rows_per_page", 15));

        return view("backend.countries.members", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create countries")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['title'] = trans("countries.backend_page_create_header");
       

        return view("backend.countries.create", $this->data);
    }

    function store(Request $request)
    {
        $rules = [
            'code' => "required|max:4|unique:countries",
            'region_id' => "required|integer",
        ];
        $messages = [
            'code.required' => trans("countries.validation_code_required"),
            'code.unique' => trans("countries.validation_code_unique"),
            'region_id.required' => trans("countries.validation_region_required"),
        ];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $messages["name.$locale.required"] = trans("countries.validation_name_in_locale_required", ["locale" => $properties['native']]);
        }


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $country = new Country();
        $country->region_id = strtoupper($request->input('region_id'));
        $country->code = strtoupper($request->input('code'));

        if ($request->input('flag')) {
            $country->flag = $request->input('flag');
        }
        if ($request->input('photo')) {
            $country->photo = $request->input('photo');
        }



        if ($country->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $country->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $country->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $country->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }
            $country->save();

        }

        return redirect($this->data['backend_uri'] . "/countries")->with(['message' => trans("countries.success_created"), 'alert-type' => 'success']);


    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit countries")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $country = Country::find($id);
        if (!$country) {
            flash(trans("countries.id_not_found"), 'danger');

            return redirect()->back();
        }


        $this->data['title'] = trans("countries.backend_page_update_header");
        $this->data['data'] = $country;

        return view("backend.countries.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit countries")) {

            return redirect()->back()->with(['message'=>trans("permissions.permission_denied"),"alert-type"=>"error"]);
        }

        $rules = [
            'code' => "required|max:4|unique:countries,code,{$id}",
            'region_id' => "required|integer",
        ];

        $messages = [
            'code.required' => trans("countries.validation_code_required"),
            'code.unique' => trans("countries.validation_code_unique"),
            'region_id.required' => trans("countries.validation_region_required"),

        ];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $messages["name.$locale.required"] = trans("countries.validation_name_in_locale_required", ["locale" => $properties['native']]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $country = Country::find($id);
        $country->region_id = strtoupper($request->input('region_id'));
        $country->code = strtoupper($request->input('code'));

        if ($request->input('photo')) {
            $country->photo = $request->input('photo');
        }
        if ($request->input('flag')) {
            $country->flag = $request->input('flag');
        }


        if ($country->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $country->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $country->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $country->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }
            $country->save();

        }
        return redirect($this->data['backend_uri'] . "/countries")
            ->with(['message' => trans("countries.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete countries")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $country = Country::find($id);
        if (!$country) {
            return redirect()->back()->with(['message' => trans("countries.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $country->flag;


        if ($country->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);

            return redirect()->back()->with(['message' => trans("countries.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("countries.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete countries")) {
            flash(trans("permissions.permission_denied"), "warning");
            return redirect()->back();
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $country = Country::find($id);

                if ($country) {
                    $defaultPhoto = $country->flag;


                    if ($country->delete()) {
                        $uploader = new UploaderController();
                        $uploader->delete($defaultPhoto);
                    }

                    $deleted++;
                }
            }


            return redirect()->back()->with(['message' => trans("countries.success_multi_delete", ['count' => $deleted]), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("countries.error_multi_delete_empty"), 'alert-type' => 'error']);

    }


}
