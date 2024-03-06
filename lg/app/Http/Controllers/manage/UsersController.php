<?php

namespace App\Http\Controllers\manage;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Validator;

class UsersController extends ManageController
{

    function index(Request $request)
    {
        $this->data['page_title'] = trans("users.page_title");
        $this->data['page_header'] = trans("users.page_header");

        $users = null;

        if ($request->input('q')) {
            $users = User::latest()->where("permission", ">", 0)->where(function ($query) {
                global $request;
                $q = $request->input('q');

                $query->where('name', 'like', "%$q%")->orWhere("email", 'like', "%$q%");
            })->paginate(15);

        } else {

            $users = User::latest()->where("permission", ">", 0)->paginate(15);

        }

        $this->data['data'] = $users;
        return view("manage.users.index", $this->data);
    }

    function create(Request $request)
    {
        $this->data['page_header'] = trans("users.page_header");
        $this->data['page_title'] = trans("users.page_title");
        return view("manage.users.create", $this->data);
    }

    function edit(Request $request, $id)
    {

        $user = User::find($id);

        if (!$user) {
            flash(trans("users.error_id_not_found"), "error");
            return redirect("/");
        }

        $this->data['page_header'] = trans("users.page_header");
        $this->data['page_title'] = trans("users.page_title");
        $this->data['data'] = $user;
        return view("manage.users.edit", $this->data);

    }

    function store(Request $request)
    {

        $rules = [
            'name' => "required|max:255",
            'email' => "email|required|max:255|unique:users,email",
            'password' => "required|alpha_num|min:6|max:32|confirmed",
            'address' => "max:255",
            'permission' => "required|between:1,2",
            'annual_sales' => "integer",
            'phone' => 'numeric',
            'mobile' => 'numeric',
            'about' => 'min:10',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("manage/users/create")
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->permission = $request->input('permission');
        $user->address = $request->input('address');
        $user->company = $request->input('company');
        $user->phone = $request->input('phone');
        $user->mobile = $request->input('mobile');
        $user->annual_sales = $request->input('annual_sales');
        $user->about = $request->input('about');
        if ($request->input('avatar')) {
            $user->avatar = $request->input('avatar');
        }

        $user->save();

        flash(trans("users.created_successfully"), "success");
        return redirect("manage/users");


    }

    function update(Request $request, $id = 0)
    {

        $rules = [
            'name' => "required|max:255",
            'email' => "email|required|max:255|unique:users,email,{$id}",
            'password' => "alpha_num|min:6|max:32|confirmed",
            'address' => "max:255",
            'permission' => "required|between:1,2",
            'annual_sales' => "integer",
            'phone' => 'numeric',
            'mobile' => 'numeric',
            'about' => 'min:10',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("manage/users/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->permission = $request->input('permission');
        $user->address = $request->input('address');
        $user->company = $request->input('company');
        $user->phone = $request->input('phone');
        $user->mobile = $request->input('mobile');
        $user->annual_sales = $request->input('annual_sales');
        $user->about = $request->input('about');
        if ($request->input('avatar')) {
            $user->avatar = $request->input('avatar');
        }

        $user->save();

        flash(trans("users.updated_successfully", ['name' => $request->input('name')]), "success");
        return redirect("manage/users");


    }

    function delete(Request $request, $id = 0)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect("manage/users")->withErrors(trans("users.error_id_not_found"));
        }

        if ($user->delete()) {
            flash(trans("users.deleted_successfully"), "success");
        } else {
            flash(trans("users.error_delete"), "error");
        }
        return redirect("manage/users");

    }

    function postUpload(Request $request)
    {
        $photo = null;
        $filename = null;
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $photo = $request->file('file');

            $filename = Str::lower(
                "avatar-" . str_replace(' ', '-', pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME))
                . '-'
                . uniqid()
                . '.'
                . $photo->getClientOriginalExtension()
            );
            $photo->move(config('settings.upload_path'), $filename);
            $small = Image::make(config('settings.upload_path') . "/" . $filename);
            $small->resize(100, 100);
            $small_destination = config('settings.upload_path') . '/small/';
            $small->save($small_destination . "/" . $filename);
            return response()->json(['success' => true, 'file' => $filename, 'small' => $small_destination . "/" . $filename]);
        }

        return response()->json(['success' => false, "message" => "No files selected to upload!"]);
    }
}
