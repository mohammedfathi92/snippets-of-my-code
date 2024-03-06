<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Managers
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->permission < 2) {
            return redirect("/")->withErrors(["error"=>trans("main.management_access_denied")]);
        }
        return $next($request);
    }
}
