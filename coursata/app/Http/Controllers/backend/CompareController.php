<?php

namespace Corsata\Http\Controllers\backend;

use Corsata\CompareAttr;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use Corsata\Http\Requests;

class CompareController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show settings")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        

        $this->data['title'] = 'Comprations Attributes';
         $this->data['method'] = "post";
        $this->data['attrs'] = CompareAttr::all();
        return view("backend.compare.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create settings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

       
        $this->data['page_title'] = 'Comprations Attributes';
        $this->data['page_header'] = 'إنشاء عنصر مقارنة جديد';
        $this->data['attrs'] = CompareAttr::all();
        $this->data['method'] = 'post';
        return view("backend.compare.index", $this->data);
    }

    function store(Request $request)
    {
      

        $rules = [
            'type'       => "required",
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

        $attr = new CompareAttr();
        $attr->slug = $request->input('slug') ?: null;
       $attr->order = (int)$request->input('order');
       $attr->status = (bool)$request->input('status')?:true;

        if ($attr->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $attr->translateOrNew($locale)->name = $request->input('name.' . $locale);
            }
            $attr->save();

        }

        return redirect($this->data['backend_uri'] . "/compare/attributes")->with(['message' => trans("main.success_created"), 'alert-type' => 'success']);


    }

   

    function edit($id = 0)
   {
        if (!Auth::user()->can("edit settings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

       
        $this->data['page_title'] = 'Comprations Attributes';
        $this->data['page_header'] = 'تعديل عنصر مقارنة';
        $this->data['attrs'] = CompareAttr::all();
        $this->data['method'] = 'put';
        return view("backend.compare.index", $this->data);
    }
    function update(Request $request,$id = 0)
    {
      

        $rules = [
            'type'       => "required",
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
        $attr = CompareAttr::find($id);
        $attr->slug = $request->input('slug') ?: null;
       $attr->order = (int)$request->input('order');
       $attr->status = (bool)$request->input('status')?:true;

        if ($attr->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $attr->translateOrNew($locale)->name = $request->input('name.' . $locale);
            }
            $attr->save();

        }

        return redirect($this->data['backend_uri'] . "/compare/attributes")->with(['message' => trans("main.success_created"), 'alert-type' => 'success']);

    }

    function delete(Request $request, $id = 0)
    {

        if (!Auth::user()->can("delete settings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $attr = CompareAttr::find($id);
        if (!$attr) {
            return redirect("/" . $this->data['backend_uri'] . "/compare/attributes")->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);
        }
       $attr->delete();
       
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
                $attr = CompareAttr::find($id);

                if ($attr) {
                   $attr->delete();

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
