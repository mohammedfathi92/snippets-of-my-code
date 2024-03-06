<?php

namespace App\Http\Controllers\manage;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use LaravelLocalization;
use Validator;

class CategoriesController extends ManageController
{

    function index(Request $request)
    {
        $this->data['page_title'] = trans("categories.page_title");
        $this->data['page_header'] = trans("categories.page_header");

        $categories = null;
        if ($request->input('q')) {
            $q = $request->input('q');
            $categories = Category::whereTranslationLike("name", "%$q%")->latest()->paginate(15);

        } else {
            $categories = Category::latest()->with('products')->paginate(15);
        }
        $this->data['data'] = $categories;
        return view("manage.categories.index", $this->data);
    }

    function create()
    {
        $this->data['page_title'] = trans("categories.page_title");
        $this->data['page_header'] = trans("categories.title_create");

        return view("manage.categories.create", $this->data);
    }

    function store(Request $request)
    {
        $rules = [

        ];
        $messages = [
            'name.ar.required'   => trans("categories.validation_arabic_name_required"),
            'name.en.required'   => trans("categories.validation_english_name_required"),
            'name.ar.max'        => trans("categories.validation_name_max", ['max' => 255]),
            'name.en.max'        => trans("categories.validation_name_max", ['max' => 255]),
            'description.ar.max' => trans("categories.validation_description_max", ['max' => 255]),
            'description.en.max' => trans("categories.validation_description_max", ['max' => 255]),
        ];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if (App::isLocale($locale)) {
                $rules["name.$locale"] = "required|max:255";
                $messages["name.$locale.required"] = trans("categories.validation_name_in_locale_required", ['locale' => $locale]);

            } else {
                $rules["name.$locale"] = "max:255";
                $rules["description.$locale"] = "max:500";
            }

        }
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('manage/categories/create')
                ->withErrors($validator)
                ->withInput();
        }

        $category = new Category();
        $category->photo = null;
        $category->created_by = Auth::user()->id;
        $category->save();

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $category->translateOrNew($locale)->name = $request->input("name.{$locale}");
            $category->translateOrNew($locale)->description = $request->input("description.{$locale}");
        }
        $category->save();
        flash(trans("categories.created_successfully"));
        return redirect("/manage/categories");
    }

    function update(Request $request, $id)
    {
        $rules = [];
        $messages = [
            'name.ar.required'   => trans("categories.validation_arabic_name_required"),
            'name.en.required'   => trans("categories.validation_english_name_required"),
            'name.ar.max'        => trans("categories.validation_name_max", ['max' => 255]),
            'name.en.max'        => trans("categories.validation_name_max", ['max' => 255]),
            'description.ar.max' => trans("categories.validation_description_max", ['max' => 255]),
            'description.en.max' => trans("categories.validation_description_max", ['max' => 255]),
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if (App::isLocale($locale)) {
                $rules["name.$locale"] = "required|max:255";
                $messages["name.$locale.required"] = trans("categories.validation_name_in_locale_required", ['locale' => $locale]);

            } else {
                $rules["name.$locale"] = "max:255";
                $rules["description.$locale"] = "max:500";
            }

        }
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("manage/categories/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $category = Category::find($id);
        $category->photo = null;
        $category->save();

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $category->translateOrNew($locale)->name = $request->input("name.{$locale}")?:null;
            $category->translateOrNew($locale)->description = $request->input("description.{$locale}")?:null;
        }
        $category->save();
        flash(trans("categories.updated_successfully", ['name' => $category->{"name:{$this->data['locale']}"}]), 'success');
        return redirect("/manage/categories");
    }

    function edit(Request $request, $id)
    {

        $category = Category::find($id);
        if (!$category) {
            return redirect("/manage/categories")->withErrors([trans('categories.error_id_not_found')]);
        }

        $this->data['data'] = $category;
        $this->data['page_title'] = trans("categories.page_title");
        $this->data['page_header'] = trans("categories.title_update");

        return view("manage.categories.edit", $this->data);
    }

    function delete(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect("/manage/categories")->withErrors([trans('categories.error_id_not_found')]);
        }
        // delete all related products
//        $category->products->delete();
        // then delete the category
        $category->delete();
        flash(trans("categories.deleted_successfully"), 'success');

        return redirect("/manage/categories");

    }
}
