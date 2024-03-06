<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super Administrator
        DB::table("users")->insert([
            'id'=>1,
            'first_name' => "Super",
            'last_name' => "Admin",
            'name' => "Super Admin",
            'email' => "admin@example.com",
            'slug' => "super-admin",
            'password' => bcrypt("123456"),
            'level' => 0,// super admin permission
            'gender' => "m",
            'lang' => 'en',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table("users")->insert([
            'id'=>2,
            'first_name' => "Mohammed",
            'last_name' => "Zedan",
            'name' => "Mohammed Zedan",
            'slug' => "Mohammed-zedan",
            'email' => "php.Mohammedfathi@gmail.com",
            'password' => bcrypt("123456"),
            'level' => 1, // Administrator permission
            'gender' => "m",
            'lang' => 'ar',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table("users")->insert([
            'id'=>3,
            'first_name' => "Mohammed",
            'last_name' => "Ibrahim",
            'name' => "Mohammed Ibrahim",
            'slug' => "mohammed-ibrahem",
            'email' => "mohammed@example.com",
            'password' => bcrypt("123456"),
            'level' => 2, // Normal user permission
            'gender' => "m",
            'lang' => 'en',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
