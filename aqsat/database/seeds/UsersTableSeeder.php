<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;
use App\Profile;
use App\Company_account;
use App\Group;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            $role = Role::where('name', 'admin')->firstOrFail();

            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'remember_token' => str_random(60),
                'role_id' => $role->id,
                'is_investor' => 1,
                'level' => 1  //level = 1 admin
            ]);

            Profile::create([
                'user_id' => $user->id,
            ]);

            Company_account::create([
                'user_id'=>$user->id,
                'user_name' => $user->name,
                'user_type' => 'company',
                'account_name' => 'company_account',
                'account_number' => 1,
                'account_value' => 0,
            ]);

            Group::create([
                'name' => 'عام',
                'created_by' => 1,
                'updated_by' => 1,
            ]);



        }

    }
}
