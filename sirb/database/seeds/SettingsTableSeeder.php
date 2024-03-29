<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('settings')->delete();

        \DB::table('settings')->insert([
            [
                'key'          => 'title',
                'display_name' => 'Site Title :: اسم الموقع',
                'value'        => 'Site Title',
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
            ],
            [
                'key'          => 'url',
                'display_name' => 'Site Url :: رابط الموقع',
                'value'        => 'http://www.example.com',
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
            ],
            [
                'key'          => 'ar_title',
                'display_name' => 'Site Title In Arabic :: اسم الموقع باللغة العربية',
                'value'        => 'Site Title',
                'details'      => '',
                'type'         => 'text',
                'order'        => 2,
            ],
            [
                'key'          => 'en_title',
                'display_name' => 'Site Title In English :: اسم الموقع باللغة الإنجليزية',
                'value'        => 'Site Title',
                'details'      => '',
                'type'         => 'text',
                'order'        => 3,
            ],
            [
                'key'          => 'ar_meta_description',
                'display_name' => 'Site Description In Arabic :: وصف الموقع باللغة العربية',
                'value'        => 'Site Description',
                'details'      => '',
                'type'         => 'text_area',
                'order'        => 4,
            ],
            [
                'key'          => 'en_meta_description',
                'display_name' => 'Site Description In English :: وصف الموقع باللغة الإنجليزية',
                'value'        => 'Site Description',
                'details'      => '',
                'type'         => 'text_area',
                'order'        => 5,
            ],
            [
                'key'          => 'ar_meta_tags',
                'display_name' => 'Meta Tags In Arabic :: كلمات الميتا باللغة العربية',
                'value'        => '',
                'details'      => '',
                'type'         => 'text_area',
                'order'        => 6,
            ],
            [
                'key'          => 'en_meta_tags',
                'display_name' => 'Meta Tags In English :: كلمات الميتا باللغة الإنجليزية',
                'value'        => '',
                'details'      => '',
                'type'         => 'text_area',
                'order'        => 7,
            ],
            [

                'key'          => 'logo',
                'display_name' => 'Site Logo :: لوجو الموقع',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 8,
            ],
            [
                'key'          => 'favicon',
                'display_name' => 'Website Icon :: أيقونة رمز الموقع',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 8,
            ],
            [
                'key'          => 'admin_bg_image',
                'display_name' => 'Admin Background Image :: صورة خلفية صفحة تسجيل دخول لوحة التحكم',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 9,
            ],
            [
                'key'          => 'admin_title',
                'display_name' => 'Admin Title :: عنوان لوحة التحكم',
                'value'        => 'DevelopNet',
                'details'      => '',
                'type'         => 'text',
                'order'        => 10,
            ],
            [
                'key'          => 'admin_description',
                'display_name' => 'Admin Description :: وصف لوحة التحكم',
                'value'        => 'Welcome Back to Admin Panel',
                'details'      => '',
                'type'         => 'text',
                'order'        => 11,
            ],
            [
                'key'          => 'google_analytics_client_id',
                'display_name' => 'Google Analytics Client ID :: كود إحصائيات جوجل أناليسيس',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 12,
            ],
            [
                'key'          => 'backend_uri',
                'display_name' => 'Backend URI :: اسم لوحة التحكم في الرابط',
                'value'        => 'admin',
                'details'      => '',
                'type'         => 'text',
                'order'        => 13,
            ],
            [
                'key'          => 'country_hotels_count',
                'display_name' => 'Number Of Hotels In Country Page :: عدد الفنادق في رئيسية الدولة',
                'value'        => '5',
                'details'      => '',
                'type'         => 'text',
                'order'        => 16,
            ],
            [
                'key'          => 'country_places_count',
                'display_name' => 'Number Of Places in Country Page :: عدد الأماكن السياحية في رئيسية الدولة',
                'value'        => '5',
                'details'      => '',
                'type'         => 'text',
                'order'        => 17,
            ],
            [
                'key'          => 'country_packages_count',
                'display_name' => 'Number Of Packages in Country Page :: عدد العروض السياحية في رئيسية الدولة',
                'value'        => '5',
                'details'      => '',
                'type'         => 'text',
                'order'        => 17,
            ],
            [
                'key'          => 'home_country_count',
                'display_name' => 'Number Of Countries in Home Page :: عدد الوجهات السياحية في الصفحة الرئيسية',
                'value'        => '3',
                'details'      => '',
                'type'         => 'text',
                'order'        => 18,
            ],
            [
                'key'          => 'home_packages_count',
                'display_name' => 'Number Of Packages in Home Page :: عدد العروض السياحية في الصفحة الرئيسية',
                'value'        => '3',
                'details'      => '',
                'type'         => 'text',
                'order'        => 19,
            ],
            [
                'key'          => 'help_email',
                'display_name' => 'Site email fore help :: البريد الإلكتروني في مربع المساعدة ',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 20,
            ],
            [
                'key'          => 'help_phone',
                'display_name' => 'Phone Number fore help :: ارقام المساعدة',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 21,
            ], [
                'key'          => 'home_packages_section_background',
                'display_name' => 'Background for Packages Section :: صورة خلفية للعروض السياحية في رئيسية الموقع',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 23,
            ], [
                'key'          => 'home_packages_section_photo',
                'display_name' => 'Photo for Packages Section :: صورة تظهر بجوار العروض السياحية في رئيسية الموقع',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 24,
            ],

            [
                'key'          => 'twitter',
                'display_name' => 'twitter URL :: رابط تويتر',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 25,
            ],
            [
                'key'          => 'googleplus',
                'display_name' => 'google plus URL :: رابط جوجل بلس',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 26,
            ],
            [
                'key'          => 'facebook',
                'display_name' => 'facebook URL :: راب فيسبوك',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 27,
            ],
            [
                'key'          => 'linkedin',
                'display_name' => 'linkedin URL :: رابط لينكد ان',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 28,
            ],
            [
                'key'          => 'vimeo',
                'display_name' => 'vimeo URL :: رابط فيمو',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 29,
            ],
            ['key'          => 'dribble',
             'display_name' => 'dribble URL :: رابط دريبل',
             'value'        => '',
             'details'      => '',
             'type'         => 'text',
             'order'        => 30,
            ],
            [
                'key'          => 'flickr',
                'display_name' => 'flickr URL :: رابط فليكر',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 31,
            ],
            [
                'key'          => 'youtube',
                'display_name' => 'Youtube URL :: رابط يوتيوب',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 30,
            ],
            [
                'key'          => 'tumblr',
                'display_name' => 'tumblr URL :: رابط تمبلر',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 30,
            ],
            [
                'key'          => 'wordpress',
                'display_name' => 'Wordpress URL :: رابط وردبريس',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 30,
            ],
            [
                'key'          => 'reddit',
                'display_name' => 'Reddit URL :: رابط ريديت',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 30,
            ],
            [
                'key'          => 'pinterest',
                'display_name' => 'Pinterest URL :: رابط بينت بريست',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 30,
            ],
            [
                'key'          => 'whatsapp_number',
                'display_name' => 'whatsapp Number :: أرقام واتس اب',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 31,
            ],
            [
                'key'          => 'show_share_buttons',
                'display_name' => 'Show Share Buttons :: إظهار أيقونات المشاركة',
                'value'        => '0',
                'details'      => '',
                'type'         => 'checkbox',
                'order'        => 31,
            ],
            [
                'key'          => 'addthis_code',
                'display_name' => 'Addthis code :: كود Add this  لأيقونات المشاركة',
                'value'        => '',
                'details'      => '',
                'type'         => 'text_area',
                'order'        => 31,
            ],

            [
                'key'          => 'show_help_box',
                'display_name' => 'Show Help Box :: عرض مربع المساعدة',
                'value'        => '1',
                'details'      => '',
                'type'         => 'checkbox',
                'order'        => 31,
            ],

            [
                'key'          => 'ar_help_box_title',
                'display_name' => 'Help box title in Arabic :: عنوان مربع المساعدة باللغة العربية',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 32,
            ],
            [
                'key'          => 'en_help_box_title',
                'display_name' => 'Help box title in English :: عنوان مربع المساعدة باللغة الإنجليزية',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 33,
            ],
            [
                'key'          => 'ar_help_box_details',
                'display_name' => 'Help box details in Arabic :: نص مربع المساعدة باللغة العربية',
                'value'        => '',
                'details'      => '',
                'type'         => 'rich_text_box',
                'order'        => 34,
            ],
            [
                'key'          => 'en_help_box_details',
                'display_name' => 'Help box details in English :: نص مربع المساعدة باللغة الإنجليزية',
                'value'        => '',
                'details'      => '',
                'type'         => 'rich_text_box',
                'order'        => 35,
            ],
            [
                'key'          => 'en_currency',
                'display_name' => 'Currency Name in English :: اسم العملة باللغة الإنجليزية',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 36,
            ],
            [
                'key'          => 'ar_currency',
                'display_name' => 'Currency name In Arabic :: اسم العملة باللغة العربية',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 37,
            ],
            [
                'key'          => 'currency_on_right',
                'display_name' => 'Show currency symbol on right of price :: تفعيل ظهور رمز العملة على يمين السعر',
                'value'        => '1',
                'details'      => '',
                'type'         => 'checkbox',
                'order'        => 38,
            ],
            [
                'key'          => 'receivers_emails',
                'display_name' => 'Receivers Emails :: البريد الإلكتروني لاستقبال جميع رسائل الموقع',
                'value'        => '',
                'details'      => '',
                'type'         => 'text_area',
                'order'        => 39,
            ],


        ]);


    }
}
