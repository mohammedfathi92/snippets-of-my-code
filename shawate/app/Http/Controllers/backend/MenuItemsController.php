<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 11/8/16
 * Time: 11:20 PM
 */

namespace app\Http\Controllers\backend;

use App\Http\Controllers\backend\BackendBaseController;
use App\Menu;
use App\MenuItem;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class MenuItemsController extends BackendBaseController
{
    function index($menu_id = 0)
    {

        if (!Auth::user()->can("show menus")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $menu = Menu::find($menu_id);
        if (!$menu) {
            return redirect()->back()->with(['message' => trans("menus.id_not_found"), 'alert-type' => 'error']);
        }
        $this->data['menu'] = $menu;
        return view("backend.menu_items.index", $this->data);
    }

    function create($menu_id = 0)
    {

        if (!Auth::user()->can("create menus")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $menu = Menu::find($menu_id);
        if (!$menu) {
            return redirect()->back()->with(['message' => trans("menus.id_not_found"), 'alert-type' => 'error']);
        }
        $this->data['menu'] = $menu;
        return view("backend.menu_items.create", $this->data);
    }

    function store(Request $request, $menu_id = 0)
    {
        if (!Auth::user()->can("create menus")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $menu = Menu::find($menu_id);
        if (!$menu) {
            return redirect()->back()->with(['message' => trans("menus.id_not_found"), 'alert-type' => 'error']);
        }
        $rules["url"] = "required";
        $messages = [];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["title.$locale"] = "required|max:255";
            $messages["title.$locale.required"] = trans("menu_items.validation_name_locale_required", ['locale' => $properties['native']]);
        }


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->url = $request->input('url') ?: "/";
        $menuItem->parent_id = (int)$request->input('parent') ?: 0;
        $menuItem->target = $request->input('target') ?: "_self";
        $menuItem->css_class = $request->input('css_class');
        $menuItem->order = (int)$request->input('sort') ?: 1;
        $menuItem->status = (boolean)$request->input('status');


        if ($menuItem->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $menuItem->translateOrNew($locale)->title = $request->input('title.' . $locale);
            }

            $menuItem->save();

        }

        return redirect($this->data['backend_uri'] . "/menus/$menu_id/items")->with(['message' => trans("menu_items.success_created"), 'alert-type' => 'success']);


    }


    function edit($menu_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit menus")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $menu = Menu::find($menu_id);
        if (!$menu) {
            return redirect()->back()->with(['message' => trans("menus.id_not_found"), 'alert-type' => 'error']);
        }

        $menuItem = MenuItem::find($id);
        if (!$menuItem) {
            return redirect()->back()->with(['message' => trans("menu_items.id_not_found"), 'alert-type' => 'error']);
        }
        $this->data['menu'] = $menu;
        $this->data['data'] = $menuItem;

        return view("backend.menu_items.edit", $this->data);
    }

    function update(Request $request, $menu_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit menus")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }


        $menu = Menu::find($menu_id);
        if (!$menu) {
            return redirect()->back()->with(['message' => trans("menus.id_not_found"), 'alert-type' => 'error']);
        }

        $menuItem = MenuItem::find($id);
        if (!$menuItem) {
            return redirect()->back()->with(['message' => trans("menu_items.id_not_found"), 'alert-type' => 'error']);
        }

        $rules["url"] = "required";
        $messages = [];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["title.$locale"] = "required|max:255";
            $messages["title.$locale.required"] = trans("menu_items.validation_name_locale_required", ['locale' => $properties['native']]);
        }


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $menuItem->menu_id = $menu->id;
        $menuItem->url = $request->input('url') ?: "/";
        $menuItem->parent_id = (int)$request->input('parent') ?: 0;
        $menuItem->target = $request->input('target') ?: "_self";
        $menuItem->css_class = $request->input('css_class');
        $menuItem->order = (int)$request->input('sort') ?: 1;
        $menuItem->status = (boolean)$request->input('status');


        if ($menuItem->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $menuItem->translateOrNew($locale)->title = $request->input('title.' . $locale);
            }

            $menuItem->save();
        }

        return redirect($this->data['backend_uri'] . "/menus/$menu_id/items")->with(['message' => trans("menu_items.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $menu_id = 0, $id = 0)
    {
        if (!Auth::user()->can("delete menus")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $menu = Menu::find($menu_id);
        if (!$menu) {
            return redirect()->back()->with(['message' => trans("menus.id_not_found"), 'alert-type' => 'error']);
        }


        $menu = MenuItem::find($id);
        if (!$menu) {
            return redirect()->back()->with(['message' => trans("menu_items.id_not_found"), 'alert-type' => 'error']);
        }


        if ($menu->delete()) {

            return redirect()->back()->with(['message' => trans("menu_items.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("menu_items.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete menus")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $menu = MenuItem::find($id);

                if ($menu) {


                    if ($menu->delete()) {
                        $deleted++;
                    }


                }
            }

            return redirect()->back()->with(['message' => trans("menu_items.success_multi_delete", ['count' => $deleted]), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("menu_items.error_multi_delete_empty"), 'alert-type' => 'warning']);

    }


}
