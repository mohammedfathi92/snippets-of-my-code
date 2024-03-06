<?php

namespace Corsata\Http\Controllers\Auth;

use Corsata\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
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
     * Where to redirect users after login.
     *
     * @var string
     */


    public function showLoginForm()
    {
        $this->data['title'] = "Register";
        $this->data['meta_description'] = "test";
        $this->data['meta_keywords'] = "test";
        $this->data['related'] = "test";
        $this->data['application_name'] = "test";
     
        return view('frontend.auth.login', $this->data);
    }

    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
}
