<?php

namespace Sirb\Http\Middleware;

use Closure;

class AllowOnlyAjaxRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->ajax()) {
            // Handle the non-ajax request
            return response('not allowed', 405);
        }
        return $next($request);
    }
}
