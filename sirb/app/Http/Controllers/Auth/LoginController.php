<?php

namespace Sirb\Http\Controllers\Auth;

use Sirb\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    protected $redirectTo = '/';
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        parent::__construct();
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

     public function showLoginForm()
     {
        $this->data['title'] = trans('auth.login_title');
        $this->data['meta_description'] = trans('auth.login_meta');
        $this->data['meta_keywords'] = trans('auth.login_keywords');
     
        return view('frontend.auth.login', $this->data);
     }
     
 

   
}
