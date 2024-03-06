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
            'name' => "mohammed Zedan",
            'slug' => "mohammed-zedan",
            'email' => "mohammedfathi1113@gmail.com",
            'password' => bcrypt("123456"),
            'level' => 1, // Administrator permission
            'gender' => "m",
            'lang' => 'ar',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table("users")->insert([
            'id'=>3,
            'name' => "Mohammed Ibrahem",
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
