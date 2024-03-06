<?php

namespace App\Http\Controllers\backend;

use App\Events\UserLogs;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use TCG\Voyager\Facades\Voyager;

use App\Http\Controllers\Controller;



class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Voyager::can('browse_users'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $title = 'users';
        $roles = DB::table('roles')->get();
        $users = User::all();
        return view('users.index', compact('users', 'title', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Voyager::can('add_users'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $roles = DB::table('roles')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|integer'
        ]);
 

       $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = bcrypt($request->input("password"));
        $user->role_id = $request->input("role_id") ?: 2;
        $saved = $user->save();


         Profile::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
        ]);


        $logs = [
            'action' => 'create_user',
            'notes' => 'user_create_user',
            'attrs' => [
                'user' => $user->id,
            ],
        ];
        event(new UserLogs($logs));

        return redirect(route('users.'))->with(['message' => __('messages.users.create')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (!Voyager::can('read_users'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $user = User::findOrFail($id);

        if (!$user)
            return redirect()->back()->with(['message' => 'no user founded', 'alert_danger' => 'info']);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Voyager::can('edit_users'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $title = 'users_edit';
        $user = User::findOrFail($id);
         $roles = DB::table('roles')->get();
        if (!$user)
            return redirect()->back()->with(['message' => 'no user founded', 'alert_danger' => 'info']);

        return view('users.edit', compact('user', 'title','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:1|max:60',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        ]);

        $user = User::findOrFail($id);

        if (!$user)
            return redirect()->back()->with(['message' => 'no user founded', 'alert_danger' => 'info']);

        $user->name = $request->input("name");
        $user->email = $request->input("email");
        if ($request->input("password"))
            $user->password = bcrypt($request->input("password"));
        $user->role_id = $request->input("role_id") ?: 2;
        $saved = $user->save();

        $profile = Profile::where('user_id', $user->id)->first();
        $profile->full_name = $user->name;
        $profile->save();
        
        $logs = [
            'action' => 'update_user',
            'notes' => 'user_update_user',
            'attrs' => [
                'user' => $user->id,
            ],
        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message' => __('messages.users.update')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (!Voyager::can('delete_users'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        if ($id == 1)
            return redirect()->back()->with(['message' => 'you can not delete this user', 'alert_danger' => 'info']);

        $user = User::findOrFail($id);

        if (!$user)
            return redirect()->back()->with(['message' => 'no user founded', 'alert_danger' => 'info']);

        $user->delete();


        $logs = [
            'action' => 'delete_user',
            'notes' => 'user_delete_user',
            'attrs' => [
                'user' => $user->id,
            ],
        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message' => __('messages.users.delete')]);
    }


    public function update_password(Request $request, $id)
    {
        $this->validate($request, [
            'current_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin = User::findOrFail($id);

        if (!$admin)
            return redirect()->back()->with(['message' => 'no user founded', 'alert_danger' => 'info']);

        if (Hash::check($request->input('current_password'), $admin->password)) {
            $admin->password = Hash::make($request->input('password'));
            $admin->save();

            $logs = [
                'action' => 'update_user',
                'notes' => 'user_update_user',
                'attrs' => [
                    'user' => $id,
                ],
            ];
            event(new UserLogs($logs));

            return redirect()->back()->with(['message' => __('messages.users.password_edit')]);
        } else {
            return redirect()->back()->with(['message' => __('messages.users.password_check'), 'alert_danger' => 'info']);
        }
    }
}
