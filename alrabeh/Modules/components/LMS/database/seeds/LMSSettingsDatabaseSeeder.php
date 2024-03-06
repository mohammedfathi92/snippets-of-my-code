<?php

namespace Modules\Components\LMS\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LMSSettingsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	 \DB::table('settings')->insert([
            [
                'code' => 'site_contact_phone',
                'type' => 'TEXT',
                'category' => 'General',
                'label' => 'Site contact phone',
                'value' => '(+996) 054444444',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'site_url',
                'type' => 'TEXT',
                'category' => 'General',
                'label' => 'Site URL',
                'value' => env('APP_URL'),
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'after_register_url',
                'type' => 'TEXT',
                'category' => 'General',
                'label' => 'After registration URL',
                'value' => url('/'),
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

             [
                'code' => 'home_page_background',
                'type' => 'FILE',
                'category' => 'HomePage',
                'label' => 'Home Page Background',
                'value' => '',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
           
             [
                'code' => 'office_address',
                'type' => 'TEXT',
                'category' => 'General',
                'label' => 'Office Address',
                'value' => '',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'about_site',
                'type' => 'TEXTAREA',
                'category' => 'General',
                'label' => 'About Site',
                'value' => '',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'home_about_academy',
                'type' => 'TEXTAREA',
                'category' => 'HomePage',
                'label' => 'عن الأكاديمية',
                'value' => '<p class="p-desc mt-20">القراءة على شبكة الإنترنت. يمكنك توسيع نطاق محتوى الموقع الإلكتروني الخاص بك عبر الإنترنت من خلال خلق إصدار صوتي فوري له </p>
                      <ul class="list-desc">
                        <li><i class="fa fa-check"></i>القراءة على شبكة الإنترنت. يمكنك توسيع نطاق محتوى الموقع</li>
                        <li><i class="fa fa-check"></i>القراءة على شبكة الإنترنت. يمكنك توسيع نطاق محتوى الموقع</li>
                        <li><i class="fa fa-check"></i>القراءة على شبكة الإنترنت. يمكنك توسيع نطاق محتوى الموقع</li>
                      </ul>',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'home_guide_video',
                'type' => 'TEXTAREA',
                'category' => 'HomePage',
                'label' => 'رابط فيديو تعريفي عن الأكاديمية',
                'value' => '',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(), //new 
            ],[
                'code' => 'site_pages_titles',
                'type' => 'SELECT',
                'category' => 'SEO',
                'label' => 'Site Pages Titles',
                'value' => '{"general":"","home":"","user_profile":"","courses":"","packages":"","quizzes":"","exercises":"","blog":"","categories":"", "search":"", "books":""}',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'site_meta_keywords',
                'type' => 'SELECT',
                'category' => 'SEO',
                'label' => 'Site Meta Keywords',
                'value' => '{"general":"", "home":"","user_profile":"","courses":"","packages":"","quizzes":"","blog":"","categories":"", "search":"", "books":""}',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'site_meta_descriptions',
                'type' => 'SELECT',
                'category' => 'SEO',
                'label' => 'Site Meta Descriptions',
                'value' => '{"general":"","home":"","user_profile":"","courses":"","packages":"","quizzes":"","blog":"","categories":"", "search":"", "books":""}',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'code' => 'site_meta_titles',
                'type' => 'SELECT',
                'category' => 'SEO',
                'label' => 'Site Meta Titles',
                'value' => '{"general":"","home":"","user_profile":"","courses":"","packages":"","quizzes":"","blog":"","categories":"", "search":"", "books":""}',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'code' => 'sidebar_bannar_img',
                'type' => 'FILE',
                'category' => 'General',
                'label' => 'Sidebar Banner Image',
                'value' => '',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'code' => 'sidebar_bannar_url',
                'type' => 'TEXT',
                'category' => 'General',
                'label' => 'Sidebar Banner URL',
                'value' => '#',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            
        ]);

        
    }
}
