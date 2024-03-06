<?php

namespace App\Http\Controllers\backend;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    public function my_account()
    {
        return view('admin.my_account');
    }


    public function update_info(Request $request,$id)
    {
        $this->validate($request,[

            'full_name'=> 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $admin =  User::findOrFail($id);

        $admin->name = $request->full_name;
        $admin->email = $request->email;

        $admin->save();

        $admin->profile->mobile = $request->mobile;

        $admin->profile->save();

        return redirect()->back()->with(['message'=>'تم تعديل البيانات']);
    }

    public function update_password(Request $request,$id)
    {

        $this->validate($request,[

            'current_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',

        ]);

        $admin =  User::findOrFail($id);

        if(Hash::check($request->current_password,$admin->password))
        {
            $admin->password = Hash::make($request->password);
            $admin->save();
            return redirect()->back()->with(['message'=> 'تم تعديل كلمه السر بنجاح ' ]);
        }
        else
        {
            return redirect()->back()->with(['message'=> 'عفوا كلمه المرور الحاليه غير صحيحه ' ,'alert_danger'=>'info']);
        }
    }

    public function logout()
    {
        Auth()->logout();
        return redirect('admin/login');
    }


}
