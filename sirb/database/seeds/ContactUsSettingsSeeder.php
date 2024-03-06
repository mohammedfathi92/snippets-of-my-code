<?php

use Illuminate\Database\Seeder;

class ContactUsSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('contact_us_settings')->delete();

        \DB::table('contact_us_settings')->insert([
            "id"               => 1,
            "geo_location"     => null,
            "map_background"   => null,
            "show_mobile"      => false,
            "mobile_required"  => false,
            "country_required" => false,
            "show_country"     => false,
        ]);

        \DB::table('contact_us_setting_translations')->insert([[
            'info'       => null,
            'locale'     => "en",
            "setting_id" => 1,
        ],
            [
                'info'       => null,
                'locale'     => "ar",
                "setting_id" => 1,
            ]]);
    }
}
