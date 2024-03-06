<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use LaravelLocalization;
use Settings;

class AdminAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest() || !Auth::user() || Auth::user()->level > 1) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {

                $backend_uri = Settings::get('backend_uri') ?: config("settings.backend_uri");
                $backend_path = LaravelLocalization::getCurrentLocale() . "/$backend_uri";
                if (!$request->is("$backend_path/login") && !$request->is("$backend_path/logout")) {
                    return redirect()->guest("$backend_path/login");
                }

            }
        }

        return $next($request);
    }
}
