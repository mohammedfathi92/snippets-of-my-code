<?php

namespace Modules\Components\LMS\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class GlobalSharedDataAuthServiceProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $authUser = new \Modules\Components\LMS\Models\UserLMS;
        if(Auth::check()){

        $authUser = \Modules\Components\LMS\Models\UserLMS::find(Auth()->id());

        }

       View::share('authUser', $authUser);
    }

}
