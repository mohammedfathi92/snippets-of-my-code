<?php

namespace App\Http\Controllers\backend\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\backend\BackendBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BackendBaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    	$this->redirectTo=config("settings.backend_uri")."/";

        $this->middleware('auth.admin', ['except' => 'logout']);

//        $this->middleware('guest', ['except' => 'logout']);
    }

	public function showLoginForm()
	{
		if(Auth::user() && Auth::user()->permission <2){
			return redirect($this->redirectTo);
		}
		return view('backend.auth.login');
	}

	function logout(Request $request){
		$this->guard()->logout();

		$request->session()->flush();

		$request->session()->regenerate();

		return redirect($this->redirectTo);
	}

	public function postLogin(Request $request){
		return $this->login($request);
	}

}
