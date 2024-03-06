<?php

namespace Sirb\Http\Controllers\backend;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

use Sirb\Http\Requests;
use Sirb\Http\Controllers\backend\BackendBaseController;
use Spatie\Permission\Models\Role;
use Validator;


class PermissionsController extends BackendBaseController
{
    function index()
    {
        if (!Auth::user()->can("show permissions")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("permissions.backend_page_title");
        $this->data['page_header'] = trans("permissions.backend_page_header");
        $this->data['data'] = Role::all();
        return view("backend.permissions.index", $this->data);

    }

    function create()
    {
        if (!Auth::user()->can("create permissions")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("permissions.backend_create_page_title");
        $this->data['page_header'] = trans("permissions.backend_create_page_header");
        $this->data['permissions'] = Permission::all();
        return view("backend.permissions.create", $this->data);
    }

    function store(Request $request)
    {
        if (!Auth::user()->can("create permissions")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $rules = [
            'name'        => 'required|max:255|unique:permissions',
            'permissions' => "required|array|min:1",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $role = new Role();
        $role->name = strtolower($request->input('name'));
        $role->label = $request->input('name');
        if ($role->save()) {
            // assign the selected permissions to the new role
            $role->givePermissionTo($request->input("permissions"));
//            return redirect(config("settings.backend_uri") . "/permissions")->with(['message' => trans("permissions.success_created"), 'alert-type' => 'success']);
            return redirect()->back()->with(['message' => trans("permissions.success_created"), 'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => trans("permissions.error_create"), 'alert-type' => 'error']);

    }

    function edit($id = 0)
    {
        if (!Auth::user()->can("edit permissions")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $role = Role::find($id);
        if (!$role) {
            return redirect()->back()->with(['message' => trans("permissions.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("permissions.backend_update_page_title");
        $this->data['page_header'] = trans("permissions.backend_update_page_header");
        $this->data['permissions'] = Permission::all();
        $this->data['data'] = $role;
        return view("backend.permissions.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit permissions")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $rules = [
            'name'        => 'required|max:255|unique:permissions',
            'permissions' => "required|array|min:1",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::find($id);
        $role->name = strtolower($request->input('name'));
        $role->label = $request->input('name');
        if ($role->save()) {
//            revoke all permission form the role.
            $role->permissions()->detach();
            // assign the selected permissions to the role
            $role->givePermissionTo($request->input("permissions"));

//            return redirect(config("settings.backend_uri") . "/permissions")->with(['message' => trans("permissions.success_updated"), 'alert-type' => 'success']);
            return redirect()->back()->with(['message' => trans("permissions.success_updated"), 'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => trans("permissions.error_update"), 'alert-type' => 'error']);

    }

    function delete($id = 0)
    {
        if (!Auth::user()->can("delete permissions")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $user = Role::find($id);
        if (!$user) {
            return redirect()->back()->with(['message' => trans("permissions.id_not_found"), 'alert-type' => 'error']);
        }


        $user->delete();
        return redirect()->back()->with(['message' => trans("permissions.success_deleted"), 'alert-type' => 'success']);
    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete permissions")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $user = Role::find($id);
                if ($user && $user->delete()) {
                    $deleted++;
                }
            }

            return redirect()->back()->with(['message' => trans("permissions.success_multi_delete", ['count' => $deleted]), 'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => trans("permissions.error_multi_delete_empty"), 'alert-type' => 'warning']);

    }

}
