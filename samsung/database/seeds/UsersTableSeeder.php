<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            'name'=>"Mohammed Fathi",
            'username'=>"Mohammed",
            'password'=>bcrypt("123"),
            'email'     =>"mohammedfathi1113@gmail.com",
            'level'     =>0,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()

        ]);
    }
}
