<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GiveSuperAdminAllPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Artisan::call('db:seed');

        //get first user and make him is a super administrator
        $user = \App\User::first();

        // create first permissions Role
        Role::create(['name' => "super administrator", 'label' => "Super Admin", 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]);


        if ($user) {
            $role = Role::first();
            if ($role) {
                $role->givePermissionTo(Permission::all());
                $user->syncRoles([$role->name]);
            }


        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //get first user and make him is a super administrator
        $user = \App\User::where('level',0)->first();
        if ($user && $user->count()) {

            /*$role = Role::first();
            if ($role && $role->count()) {
                $user->removeRole([Role::first()->name]);
                $role->hasPermissionTo(Permission::all());
            }*/

        }

    }
}
