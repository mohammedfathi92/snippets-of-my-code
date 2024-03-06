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
            'name'=>"Super Admin",
            'email'=>"admin@example.com",
            'password'=>bcrypt("123"),
            'permission'=>0,

            'language'=>'en',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        // partner
        DB::table("users")->insert([
            'name'=>"Mohammed Fathi",
            'email'=>"mohammedfathi1113@gmail.com",
            'password'=>bcrypt("123456"),
            'permission'=>2,
            'language'=>'ar',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
