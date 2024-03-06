<?php

namespace App\Http\Controllers\backend;

use App\FAQ;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\backend\BackendBaseController;

class FAQController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show faq")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['data'] = FAQ::all();

        return view("backend.faq.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create faq")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("faq.backend_page_title");
        $this->data['page_header'] = trans("faq.backend_page_create_header");

        return view("backend.faq.create", $this->data);
    }

    function store(Request $request)
    {
        $rules = [
            'slug' => "required|unique:faq_categories,slug",
        ];
        $messages = [];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("faq.validation_name_locale_required", ['locale' => $properties['native']]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = new FAQ();
        $category->slug = str_slug($request->input('slug')) ?: null;
        $category->type = $request->input('type') ?: null;
        $category->icon_class = $request->input('icon_class') ?: null;
        $category->sort = (int)$request->input('sort') ?: 1;
        $category->status = (boolean)$request->input('status');

        if ($category->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $category->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $category->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $category->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $category->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }
            $category->save();
        }

        return redirect($this->data['backend_uri'] . "/faq")->with(['message' => trans("faq.success_created"), 'alert-type' => 'success']);
    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit faq")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $category = FAQ::find($id);
        if (!$category) {
            return redirect()->back()->with(['message' => trans("faq.id_not_found"), 'alert-type' => 'error']);
        }
        $this->data['data'] = $category;

        return view("backend.faq.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit faq")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $category = FAQ::find($id);
        if (!$category) {

            return redirect()->back()->with(['message' => trans("faq.id_not_found"), 'alert-type' => 'error']);
        }
        $rules = [
            'slug' => "required|unique:faq_categories,slug,{$id}",
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("faq.validation_name_locale_required", ['locale' => $properties['native']]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category->slug = str_slug($request->input('slug')) ?: null;
        $category->type = $request->input('type') ?: null;
        $category->icon_class = $request->input('icon_class') ?: null;
        $category->sort = (int)$request->input('sort') ?: 1;
        $category->status = (boolean)$request->input('status');


        if ($category->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $category->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $category->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $category->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $category->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $category->save();

        }

        return redirect($this->data['backend_uri'] . "/faq")->with(['message' => trans("faq.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete faq")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $category = FAQ::find($id);
        if (!$category) {
            return redirect()->back()->with(['message' => trans("faq.id_not_found"), 'alert-type' => 'error']);
        }


        if ($category->delete()) {

            return redirect()->back()->with(['message' => trans("faq.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("faq.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete faq")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $category = FAQ::find($id);

                if ($category) {

                    if ($category->delete()) {
                        $deleted++;
                    }


                }
            }

            return redirect()->back()->with(["message" => trans("faq.success_multi_delete", ['count' => $deleted]), "alert-type" => "success"]);
        }

        return redirect()->back()->with(["message" => trans("faq.error_multi_delete_empty"), "alert-type" => "error"]);

    }


}
