<?php

namespace Sirb\Http\Controllers;

use Sirb\Http\Requests;
use Sirb\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Validator;

class UsersController extends Controller
{

    
    function index()
    {
       

    }

    function profile($id = 0, $slug = null)
    {
         $user = Auth::user();
        if (!$user) redirect()->back()->with(["message" => "users.id_not_found", "alert-type" => "error"]);

        $this->data['user'] = $user;
        $this->data['title'] = trans("users.title_user_profile") . " - " . $this->data['title'];
        $this->data['meta_description'] = $user->name."-". "profile page.";
        $this->data['meta_keywords'] = $user->name."-". "shawate travel.";;
        return view("frontend.users.profile", $this->data);
    }

    function update_profile(Request $request)
    {

       $date_before = date('Y-m-d', strtotime('-15 years'));;
        $user = Auth::user();
        $rules = [
            'name'   => "required|max:255",
            "email"  => "email|required|max:255|unique:users,email,{$user->id}",
            
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

        if (!$user) redirect()->back()->with(["message" => "users.id_not_found", "alert-type" => "error"]);

        $user->name = $request->input("name");
        $user->email = $request->input("email");
        if ($request->input("password"))
            $user->password = bcrypt($request->input("password"));
        $user->gender = $request->input("gender") ?: "m";
        $user->gender = $request->input("about") ?: null;
        $user->lang = $request->input("lang") ?: "ar";
        $user->avatar = $request->input("avatar") ?: null;


        if ($user->save()) {
            return redirect()->back()->with(['message' => trans("users.success_updated"), 'alert-type' => 'success']);

        }

        return redirect()->back()->with(['message' => 'users.error_create', 'alert-type' => 'error'])->withInput();

    }

   



    

    



}
