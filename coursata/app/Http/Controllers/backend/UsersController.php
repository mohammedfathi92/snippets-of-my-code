<?php

namespace Corsata\Http\Controllers\backend;

use Corsata\Category;
use Corsata\Country;
use Corsata\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

use Validator;
use Corsata\Http\Requests;
use Corsata\Http\Controllers\backend\BackendBaseController;

class UsersController extends BackendBaseController
{

    function index()
    {
        if (!Auth::user()->can("show users")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $this->data['page_title'] = trans("users.backend_page_title");
        $this->data['page_header'] = trans("users.backend_page_header");
        $this->data['data'] = User::where('level', "!=", 0)->paginate(config("settings.backend_rows_per_page"));
        return view("backend.users.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create users")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $this->data['permissions'] = Role::all();
        return view("backend.users.create", $this->data);
    }

    function store(Request $request)
    {
//        $date_before = date('Y-m-d', strtotime('-15 years'));;
        $rules = [
            'firstName'     => 'required|max:255',
            'firstName'     => 'required|max:255',
//            'country' => 'required',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
//            'gender' => "required|max:10",
//            'birth_day' => "date|before:{$date_before}",
//            'categories' => "required|array|min:1"
        ];

        if (Auth::user()->can('assign permissions') and $request->input('level') < 2) {
            $rules['permissions'] = "required|array|min:1";
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->name = $request->input("name");
//        $user->last_name = $request->input("last_name");
        $user->slug = str_replace(" ", "-", $request->input("name")) . "-" . rand(100, 1000);
//        $user->country_id = $request->input("country");
        $user->email = $request->input("email");
        $user->password = bcrypt($request->input("password"));
//        $user->gender = $request->input("gender") ?: "m";
//        $user->birth_day = $request->input("birth_day") ? date("Y-m-d", strtotime($request->input("birth_day"))) : null;
        $user->level = $request->input("level") ?: 2;
//        $user->lang = $request->input("lang") ?: "ar";
        $user->avatar = $request->input("avatar") ?: null;
        $saved = $user->save();

        if ($saved) {
            // assign permissions roles to current user
            if (Auth::user()->can('assign permissions')) {
                $user->syncRoles($request->input("permissions"));
            }
            return redirect(config("settings.backend_uri") . "/users")->with(['message' => trans("users.success_created"), 'alert-type' => 'success']);

        }
        return redirect()->back()->with(['message' => trans("users.error_create"), 'alert-type' => 'error'])->withInput();

    }

    function account()
    {


        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with(['message' => trans("users.id_not_found"), 'alert-type' => 'warning']);
        }
        $this->data['page_title'] = trans("users.backend_page_title");
        $this->data['page_header'] = trans("users.backend_update_page_header");
//        $this->data['countries'] = Country::all();
//        $this->data['categories'] = Category::all();
        $this->data['permissions'] = Role::all();
        $this->data['data'] = $user;

        return view("backend.users.account", $this->data);
    }

    function updateAccount(Request $request)
    {
        $date_before = date('Y-m-d', strtotime('-15 years'));;
        $user = Auth::user();
        $rules = [
            'firstName'   => "required|max:255",
            'lastName'   => "required|max:255",
            "email"  => "email|required|max:255|unique:users,email,{$user->id}",
            'gender' => "required|max:10",
        ];
        if ($request->input("password")) {
            $rules['password'] = 'min:6|confirmed';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->input("name");
        $user->email = $request->input("email");
        if ($request->input("password"))
            $user->password = bcrypt($request->input("password"));
        $user->gender = $request->input("gender") ?: "m";
        $user->lang = $request->input("lang") ?: "ar";
        $user->avatar = $request->input("avatar") ?: null;


        if ($user->save()) {
            return redirect()->back()->with(['message' => trans("users.success_updated"), 'alert-type' => 'success']);

        }

        return redirect()->back()->with(['message' => 'users.error_create', 'alert-type' => 'error'])->withInput();

    }

    function edit($id = 0)
    {
        if (!Auth::user()->can("edit users")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with(['message' => trans("users.id_not_found"), 'alert-type' => 'warning']);
        }
        $this->data['page_title'] = trans("users.backend_page_title");
        $this->data['page_header'] = trans("users.backend_update_page_header");
//        $this->data['countries'] = Country::all();
//        $this->data['categories'] = Category::all();
        $this->data['permissions'] = Role::all();
        $this->data['data'] = $user;

        return view("backend.users.edit", $this->data);
    }


    function update(Request $request, $id = 0)
    {
        $date_before = date('Y-m-d', strtotime('-15 years'));;
        $rules = [
            'firstName'     => "required|max:255",
            'lastName'     => "required|max:255",
//            'last_name' => "required|max:255",
//            'country' => "required",
            "email"    => "email|required|max:255|unique:users,email,{$id}",
            'password' => 'min:6|confirmed',
//            'gender' => "required|max:10",
//            'birth_day' => "date|before:{$date_before}",
//            'categories' => "required|array|min:1"
        ];

        if (Auth::user()->can('assign permissions') and Auth::user()->can('revoke permissions') and $request->input('level') < 2) {
            $rules['permissions'] = "required|array|min:1";
        }
        /* $messages = [
             'birth_day.before' => trans("users.not_allowed_age", ['age' => config("settings.allowed_register_age")])
         ];*/

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($id);
        $user->name = $request->input("name");
//        $user->last_name = $request->input("last_name");
//        $user->country_id = $request->input("country");
        $user->email = $request->input("email");
        if ($request->input("password"))
            $user->password = bcrypt($request->input("password"));
//        $user->gender = $request->input("gender") ?: "m";
//        $user->birth_day = $request->input("birth_day") ? date("Y-m-d", strtotime($request->input("birth_day"))) : null;
        if (!$user->isSuperAdmin())
            $user->level = $request->input("level") ?: 2;

//        $user->lang = $request->input("lang") ?: "ar";
        if ($request->input("avatar")) {
            $user->avatar = $request->input("avatar") ?: null;
        }


        $saved = $user->save();

        if ($saved) {
            // assign permissions roles to current user
            if (Auth::user()->can('assign permissions', 'revoke permissions') and $request->input('level') < 2) {
                $user->syncRoles($request->input("permissions"));
            }

            return redirect(config("settings.backend_uri") . "/users")->with(['message' => trans("users.success_updated"), 'alert-type' => 'success']);

        }

        return redirect()->back()->with(['message' => 'users.error_create', 'alert-type' => 'error'])->withInput();

    }

    function delete($id = 0)
    {
        if (!Auth::user()->can("delete users")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with(['message' => trans("users.id_not_found"), 'alert-type' => 'warning']);
        }


        $user->delete();
        return redirect()->back()->with(['message' => trans("users.success_deleted"), 'alert-type' => 'success']);
    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete users")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $user = User::find($id);
                if ($user && $user->delete()) {
                    $deleted++;
                }
            }
            return redirect()->back()->with(['message' => trans("users.success_multi_delete", ['count' => $deleted]), 'alert-type' => 'success']);
        }

        return redirect()->back()->with(['message' => trans("users.error_multi_delete_empty"), 'alert-type' => 'danger']);

    }

}
