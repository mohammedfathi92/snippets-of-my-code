<?php
/**
 * @project     : blog
 * @file        : UsersController.php
 * @created_at  : 3/4/16 - 7:11 PM
 * @author      : Mohammed Fathi (mohammedfathi1113@gmail.com)
 **/


namespace App\Http\Controllers\backend;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Laracasts\Flash\Flash;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UsersController extends BaseAdminController
{


    function getIndex()
    {
        $this->data['page_title'] = "Users";
        $data = User::where('level', 1)->get();
        $this->data['data'] = $data;
        return view("backend.users.index", $this->data);
    }

    function getLogin()
    {
        if (Auth::user()) {
           // return redirect()->intended('admin');

        }

        $this->data['page_title'] = "Login";
        return view("backend.auth.login", $this->data);
    }

    function postLogin(Request $request)
    {
        //dd("test");
        // validate the info, create rules for the inputs
        $rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

// run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

// if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('admin/login')
                ->withErrors($validator)// send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password'),


            );

            // attempt to do the login
            if (Auth::attempt($userdata, (bool)Input::get('remember'))) {

               return redirect("admin");
            }

            // validation not successful, send back to form
            return Redirect::to('admin/login')->withErrors("invalid Email or Password");

        }
    }

    function getLogout()
    {
        Auth::logout();
        return redirect("admin/login");
    }

    function account()
    {
        $this->data['page_title'] = "Account Settings";
        $this->data['data'] = Auth::user();
        return view("backend.users.account", $this->data);
    }

    function postAccount(Request $request)
    {
        $rules = [
            'name' => "required|max:255",
            'email' => "required|max:255",
            'password' => "min:6|max:32|same:password_confirmation"
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/account')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find(Auth::user()->id);
        $user->name = $request->input("name");
        $user->email = $request->input("email");

        if ($request->input("photo")) {
            $user->avatar = $request->input("photo");
        }

        if (trim($request->input("password"))) {
            $user->password = bcrypt($request->input("password"));
        }

        $user->save();
        flash("your Account Updated", 'success');

        return redirect('admin/account');
    }

    function getProfile($id = 0)
    {


        if (!intval($id)) {
            return abort(404);
        }
        $user = User::where("deleted", 0)->find($id);
        $this->data['page_title'] = trans("users.user_profile_title", ["Name" => $user->name]);
        $this->data['data'] = $user;
        return view("backend.users.profile", $this->data);
    }

    function getEdit($id = 0)
    {


        if (!intval($id)) {
            return abort(404);
        }
        if (!Auth::user()->level < 2) {
            return abort(403);
        }
        $user = User::where("deleted", 0)->find($id);

        $this->data['page_title'] = trans("users.user_edit_title", ["Name" => $user->name]);

        $this->data['data'] = $user;
        $this->data['levels'] = $this->levelsList();

        return view("backend.users.edit", $this->data);
    }

    function postEdit(Request $request, $id = 0)
    {
        $input = $request->input();

        $rules = [
            'name' => 'required|max:225',
            'email' => function ($input) {

                if ($input['old_email'] and $input['old_email'] == $input['email'])
                    return 'required|max:225|email';
                else
                    return 'required|max:225|email|unique:users';

            },
//            'email' => 'required|max:225|email|unique:users',
        ];
        $message = [
            'email.unique' => trans("users.email_exists", ['email' => $input['email']])
        ];

        if ($input["password"]) {
            $rules['password'] = "required|min:6";
        }

        $validator = Validator::make($input, $rules, $message);

        if ($validator->fails()) {
            return redirect("admin/users/edit/$id")->withErrors($validator)->withInput();
        }

        $user = User::find($id);

        $user->name = $input['name'];
        $user->email = $input['email'];


        if ($input['password']) {
            $user->password = bcrypt($input['password']);
        }

        if ($request->hasFile("avatar")) {
            $file = $request->file("avatar");
            $photo = Str::lower(
                "avatar-" . str_replace(' ', '-', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '-'
                . uniqid()
                . '.'
                . $file->getClientOriginalExtension()
            );
            $file->move(config('settings.upload_path'), $photo);
            $user->avatar = $photo;
        }

        if ($user->save()) {
            Flash::success(trans('users.user_updated_successfully'));
            return redirect("admin/users");
        } else {
            Flash::error(trans('users.user_not_updated'));
            return redirect("admin/users/edit/$id");
        }


    }

    function getCreate()
    {
        if (!Auth::user()->level < 2) {
            return abort(403);
        }


        $this->data['page_title'] = trans("users.title_create_user");
        $this->data['levels'] = $this->levelsList();

        return view("backend.users.create", $this->data);
    }

    function levelsList()
    {
        return $list = [
            1 => trans_choice("users.level_choice", 1),
            2 => trans_choice("users.level_choice", 2),
            3 => trans_choice("users.level_choice", 3),
        ];
    }

    function postCreate(Request $request)
    {
        $input = $request->input();
        $rules = [
            'name' => 'required|max:225',
            'password' => 'required|max:60|min:3',
            'email' => 'required|max:225|email|unique:users',
        ];
        $message = [
            'email.unique' => trans("users.email_exists", ['email' => $input['email']])
        ];

        $validator = Validator::make($input, $rules, $message);
        if ($validator->fails()) {
            return redirect("admin/users/create")->withErrors($validator)->withInput();
        }


        $user = new User();
        $user->name = $input['name'];
        $user->username = $input['name'] . "-" . random_int(1, 100);
        $user->email = $input['email'];
        $user->level = 1;
        $user->password = bcrypt($input['password']);

        if ($request->hasFile("avatar")) {
            $file = $request->file("avatar");
            $photo = Str::lower(
                "avatar-" . str_replace(' ', '-', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '-'
                . uniqid()
                . '.'
                . $file->getClientOriginalExtension()
            );
            $file->move(config('settings.upload_path'), $photo);
            $user->avatar = $photo;
        }

        if ($user->save()) {
            Flash::success(trans('users.user_updated_successfully'));
            return redirect("admin/users");
        }

        Flash::error(trans('users.user_not_updated'));
        return redirect("admin/users/create");


    }

    function getDelete(Request $request, $id = 0)
    {

        if (!intval($id)) {
            return abort(404);
        }

        $user = User::find($id);
        if (!$user) {
            return abort(404);
        }

        if (!Auth::user()->level < 2) {
            return abort(403);
        }

        if ($user->level == 0) {
            return redirect("admin/users")->withErrors(trans("users.can_not_delete_superadmin"));
        }

        if ($user->delete()) {
            Flash::success(trans("users.user_deleted_successfully"));
            return redirect("admin/users");
        }
        return redirect("admin/users")->withErrors(trans("users.can_not_delete_user"));
    }

    function upload(Request $request)
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