<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 8/10/16
 * Time: 8:12 PM
 */

use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super Administrator
        DB::table("about")->insert([
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        // partner
        DB::table("about_translations")->insert([[
            'title'=>"About Application",
            'body'=>"Application Description gos here",
            'locale'=>'ar',
            'about_id'=>1,
        ],
            [
                'title'=>"About Application",
                'body'=>"Application Description gos here",
                'locale'=>'en',
                'about_id'=>1,
            ]]);
    }
}
