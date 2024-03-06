<?php

namespace App\Http\Controllers\manage;

use App\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use LaravelLocalization;
use Validator;

class ClubManagementController extends ManageController
{
    /**
     * show club management levels
     */
    function index(Request $request, $parent = 0)
    {
        $this->data['page_title'] = trans("levels.page_title");
        $this->data['page_header'] = trans("levels.page_header");

        $parentData = null;

        if ($parent) {
            $parentData = Level::find($parent);
            if (!$parentData) {
                return redirect()->back()->withErrors(trans("not found"));
            }

        }
        if ($parentData) {
            $this->data['data'] = Level::latest()->where("parent_id", $parentData->id)->get();
        } else {
            $this->data['data'] = Level::latest()->where("parent_id", 0)->get();
        }
        $this->data['parent_id'] = $parent;
        $this->data['parent'] = $parentData;
        return view("manage.levels.index", $this->data);
    }

    function create(Request $request, $parent = 0)
    {
        $this->data['page_title'] = trans("levels.page_title");
        $this->data['page_header'] = trans("levels.page_header");
        $parentData = null;

        if ($parent) {

            $parentData = Level::find($parent);
            if (!$parentData) {
                return redirect()->back()->withErrors(trans("levels.id_not_found"));
            }
        }
        $this->data['parents'] = Level::latest()->get();
        $this->data['parent'] = $parentData;
        return view("manage.levels.create", $this->data);
    }

    function store(Request $request, $parent = 0)
    {

        $parentData = null;
        if ($parent) {
            $parentData = Level::find($parent);
        }
        $rules = [
            'target' => "required|numeric",
            "min"    => "required|min:0|numeric",
        ];


        $messages = [
            'name.ar.required'   => trans("levels.validation_arabic_name_required"),
            'name.en.required'   => trans("levels.validation_english_name_required"),
            'name.ar.max'        => trans("levels.validation_name_max", ['max' => 255]),
            'name.en.max'        => trans("levels.validation_name_max", ['max' => 255]),
            'description.ar.max' => trans("levels.validation_description_max", ['max' => 600]),
            'description.en.max' => trans("levels.validation_description_max", ['max' => 600]),

        ];

        if ($parentData) {
            $target = $request->input('target');// current target;
            $max = $parentData->target - 1; // parent target;
            $rules['target'] = "required|numeric|max:{$parentData->target}|min:{$parentData->min}";
            $rules['min'] = "required|numeric|max:{$max}|min:{$parentData->min}|between:{$parentData->min},{$target}";
        }

        $rules['photo'] = "required";
        $validator = Validator::make($request->all(), $rules, $messages);
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {

            if (App::isLocale($locale)) {
                $rules["name.$locale"] = "required|max:255";
                $rules["description.$locale"] = "max:600";
                $messages["name.$locale.required"] = trans("categories.validation_name_in_locale_required", ['locale' => $locale]);

            } else {
                $rules["name.$locale"] = "max:255";
                $rules["description.$locale"] = "max:600";
            }
        }
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $level = new Level();
        $level->target = $request->input('target');
        $level->min = $request->input('min');
        if ($request->input('photo')) {
            $level->photo = $request->input('photo');
        }
        if ($parent) {
            $level->parent_id = $request->input('parent');
        } else {
            $level->parent_id = 0;
        }

        if ($level->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $level->translateOrNew($locale)->name = $request->input("name.$locale") ?: null;
                $level->translateOrNew($locale)->description = $request->input("description.$locale") ?: null;
            }

        }
        $level->save();

        flash(trans("levels.success_created"), "success");

        return redirect("manage/club");


    }

    function edit(Request $request, $id = 0)
    {
        $this->data['page_title'] = trans("levels.page_title");
        $this->data['page_header'] = trans("levels.page_header");
        $parentData = null;
        $parent = $request->input('parent');

        if ($parent) {
            $parentData = Level::find($parent);
            if (!$parentData)
                return redirect()->back()->withErrors(trans(""));
        }

        $level = Level::find($id);
        if (!$level) return redirect()->back()->withErrors(trans('levels.id_not_found'));
        $this->data['parents'] = Level::latest()->get();
        $this->data['parent'] = $parentData;
        $this->data['data'] = $level;
        return view("manage.levels.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {

        $level = Level::find($id);

        $rules = [
            'target' => "required",
            "min"    => "required|min:0",
        ];


        $messages = [
            'name.ar.max'        => trans("levels.validation_name_max", ['max' => 255]),
            'name.en.max'        => trans("levels.validation_name_max", ['max' => 255]),
            'description.ar.max' => trans("levels.validation_description_max", ['max' => 600]),
            'description.en.max' => trans("levels.validation_description_max", ['max' => 600]),

        ];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {

            if (App::isLocale($locale)) {
                $rules["name.$locale"] = "required|max:255";
                $rules["description.$locale"] = "max:600";
                $messages["name.$locale.required"] = trans("categories.validation_name_in_locale_required", ['locale' => $locale]);

            } else {
                $rules["name.$locale"] = "max:255";
                $rules["description.$locale"] = "max:600";
            }
        }
        $parent = $request->input('parent');
        $parentData = null;
        if ($parent) {
            $parentData = Level::find($parent);
        }
        if ($parentData) {
            $target = $request->input('target');// current target;
            $max = $parentData->target - 1; // parent target;
            $rules['target'] = "required|numeric|max:{$parentData->target}|min:{$parentData->min}";
            $rules['min'] = "required|numeric|max:{$max}|min:{$parentData->min}|between:{$parentData->min},{$target}";
        }

        if (!$request->input("old_photo")) {
            $rules['photo'] = "required";
            $messages['photo.required'] = trans("validation.required", ["attribute" => trans("levels.label_photo")]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $level->target = $request->input('target');
        $level->min = $request->input('min');
        if ($request->input('photo')) {
            $level->photo = $request->input('photo');
        }
        $level->parent_id = (int)$request->input('parent') ?: 0;


        if ($level->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $level->translateOrNew($locale)->name = $request->input("name.$locale") ?: null;
                $level->translateOrNew($locale)->description = $request->input("description.$locale") ?: null;
            }

        }
        $level->save();

        flash(trans("levels.success_created"), "success");

        return redirect("manage/club");


    }

    function upload(Request $request)
    {

        $photo = null;
        $filename = null;
        if ($request->hasFile('file') && $request->file('file')->isValid()) {

            $photo = $request->file('file');

            $filename = Str::lower(
                "level-" . str_replace(' ', '-', pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME))
                . '-'
                . uniqid()
                . '.'
                . $photo->getClientOriginalExtension()
            );

            $photo->move(config('settings.upload_path'), $filename);

            $small = Image::make(config('settings.upload_path') . "/" . $filename);
            $small->resize(100, 100);

            $small_destination = config('settings.upload_path') . '/small';

            $small->save($small_destination . "/" . $filename);

            return response()->json(['success' => true, 'file' => $filename, 'small' => $small_destination . "/" . $filename]);
        }

        return response()->json(['success' => false, "message" => "No files selected to upload!"]);
    }

    function delete(Request $request, $id)
    {
        $level = Level::find($id);
        if ($level) {
            $level->delete();
            flash(trans('levels.deleted_successfully'), 'success');
        } else {
            flash(trans('levels.id_not_found'), 'error');
        }


        return redirect()->back();

    }
}
