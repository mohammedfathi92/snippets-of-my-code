<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 11/8/16
 * Time: 11:20 PM
 */

namespace Corsata\Http\Controllers\backend;

use Corsata\Http\Controllers\backend\BackendBaseController;
use Corsata\Menu;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;
use Corsata\Http\Requests;

class MenusController extends BackendBaseController
{
    function index()
    {
        $this->data['data'] = Menu::all();
        return view("backend.menus.index", $this->data);
    }

    function create()
    {
        return view("backend.menus.create", $this->data);
    }

    function store(Request $request)
    {

        $rules["position"] = "required";
        $messages = [];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["title.$locale"] = "required|max:255";
            $messages["title.$locale.required"] = trans("menus.validation_name_locale_required", ['locale' => $properties['native']]);
        }


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $menu = new Menu();
        $menu->position = $request->input('position');
        $menu->css_class = $request->input('class');
        $menu->order = (int)$request->input('sort') ?: 1;
        $menu->show_title = (boolean)$request->input('show_title');
        $menu->status = (boolean)$request->input('status');


        if ($menu->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $menu->translateOrNew($locale)->title = $request->input('title.' . $locale);
            }

            $menu->save();

        }

        return redirect($this->data['backend_uri'] . "/menus")->with(['message' => trans("menus.success_created"), 'alert-type' => 'success']);


    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit menus")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $menu = Menu::find($id);
        if (!$menu) {
            return redirect()->back()->with(['message' => trans("menus.id_not_found"), 'alert-type' => 'error']);
        }
        $this->data['data'] = $menu;
        
        return view("backend.menus.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit menus")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $menu = Menu::find($id);
        if (!$menu) {

            return redirect()->back()->with(['message' => trans("menus.id_not_found"), 'alert-type' => 'error']);
        }

        $rules["position"] = "required";
        $messages = [];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["title.$locale"] = "required|max:255";
            $messages["title.$locale.required"] = trans("menus.validation_name_locale_required", ['locale' => $properties['native']]);
        }


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $menu->position = $request->input('position');
        $menu->css_class = $request->input('class');
        $menu->order = (int)$request->input('sort') ?: 1;
        $menu->show_title = (boolean)$request->input('show_title');
        $menu->status = (boolean)$request->input('status');


        if ($menu->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $menu->translateOrNew($locale)->title = $request->input('title.' . $locale);
            }

            $menu->save();
        }

        return redirect($this->data['backend_uri'] . "/menus")->with(['message' => trans("menus.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete menus")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $menu = Menu::find($id);
        if (!$menu) {
            return redirect()->back()->with(['message' => trans("menus.id_not_found"), 'alert-type' => 'error']);
        }


        if ($menu->delete()) {

            return redirect()->back()->with(['message' => trans("menus.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("menus.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete menus")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $menu = Menu::find($id);

                if ($menu) {


                    if ($menu->delete()) {
                        $deleted++;
                    }


                }
            }

            return redirect()->back()->with(['message' => trans("menus.success_multi_delete", ['count' => $deleted]), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("menus.error_multi_delete_empty"), 'alert-type' => 'warning']);

    }


}
