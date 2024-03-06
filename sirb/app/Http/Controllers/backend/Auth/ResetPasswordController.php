<?php

namespace Sirb\Http\Controllers\backend\Auth;

use Sirb\Http\Controllers\backend\BackendBaseController;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends BackendBaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('');
    }
	public function showResetForm(Request $request, $token = null)
	{
		if (!$token){
			flash("You don't have invalid reset password link",'danger');
			return redirect(config("settings.backend_uri")."/password/forget");
		}

		return view('backend.auth.passwords.reset')->with(
			['token' => $token, 'email' => $request->email]
		);
	}

}
