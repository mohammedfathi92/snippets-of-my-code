<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // send email to user after account creation
        User::created(function ($user) {
            Mail::send("emails.account_created", ['user' => $user],
                function ($m) use ($user) {
                    $m->from(config("settings.app_email"), trans("main.app_title"));
                    $m->to($user->email, $user->name)
                        ->subject(trans("emails.user_account_created_subject"));
                });
            return $user;
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
