<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
           
            0 => 
            array (
                'id' => 2,
                'show_title' => 0,
                'position' => 'main_menu',
                'created_at' => '2018-01-19 18:31:14',
                'updated_at' => '2018-01-19 18:31:14',
            ),
            1 => 
            array (
                'id' => 3,
                'show_title' => 0,
                'position' => 'footer_left',
                'created_at' => '2018-01-19 18:31:14',
                'updated_at' => '2018-01-19 18:31:14',
            ),
            2 => 
            array (
                'id' => 4,
                'show_title' => 0,
                'position' => 'footer_right',
                'created_at' => '2018-01-19 19:55:51',
                'updated_at' => '2018-01-19 19:55:51',
            )
        ));

        \DB::table('menus_translations')->delete();

        \DB::table('menus_translations')->insert(array (
            
        
            
               0 => 
            array (
                'id' => 1,
                'locale' => 'ar',
                'title' => "Main Menu",
                'menu_id' => 1,
                'created_at' => '2018-01-19 19:55:51',
                'updated_at' => '2018-01-19 19:55:51',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => "Main Menu",
                'menu_id' => 1,
                'locale' => 'en',
                'created_at' => '2018-01-19 19:55:51',
                'updated_at' => '2018-01-19 19:55:51',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => "Footer Right",
                'menu_id' => 2,
                'locale' => 'ar',
                'created_at' => '2018-01-19 19:55:51',
                'updated_at' => '2018-01-19 19:55:51',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => "Footer Right",
                'menu_id' => 2,
                'locale' => 'en',
                'created_at' => '2018-01-19 19:55:51',
                'updated_at' => '2018-01-19 19:55:51',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => "Footer left",
                'menu_id' => 3,
                'locale' => 'ar',
                'created_at' => '2018-01-19 18:31:14',
                'updated_at' => '2018-01-19 18:31:14',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => "Footer left",
                'menu_id' => 3,
                'locale' => 'en',
                'created_at' => '2018-01-19 19:55:51',
                'updated_at' => '2018-01-19 19:55:51',
            )
        ));
        
        
    }
}
