<?php

namespace Modules\Components\LMS\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LMSMenusDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Frontend Footer Root Menu
        $lms_frontend_footer_menu = \DB::table('menus')->insertGetId([
            'parent_id'       => 0,
            'key'             => 'lms_frontend_footer',
            'url'             => null,
            'active_menu_url' => null,
            'name'            => 'Frontend Footer Root Menu',
            'description'     => 'Frontend Footer Root Menu',
            'icon'            => '',
            'target'          => null,
            'roles'           => '',
            'order'           => 0
        ]);
        // Frontend Root Menu
        $lms_frontend_menu = \DB::table('menus')->insertGetId([
            'parent_id'       => 0,
            'key'             => 'lms_frontend',
            'url'             => null,
            'active_menu_url' => null,
            'name'            => 'Frontend Root Menu',
            'description'     => 'Frontend Root Menu',
            'icon'            => '',
            'target'          => null,
            'roles'           => '',
            'order'           => 0
        ]);

    // seed  Frontend children menu
        \DB::table('menus')->insert([
             //home page
                [
                    'parent_id'       => $lms_frontend_menu,
                    'key'             => null,
                    'url'             => '/',
                    'active_menu_url' => '',
                    'name'            => __('LMS::attributes.menu.home'),
                    'description'     => 'Home List Menu Item',
                    'icon'            => '',
                    'target'          => null,
                    'roles'           => '',
                    'order'           => 0
                ],
                //courses
                [
                    'parent_id'       => $lms_frontend_menu,
                    'key'             => null,
                    'url'             => route('courses.index'),
                    'active_menu_url' => '/courses*',
                    'name'            => __('LMS::attributes.menu.courses'),
                    'description'     => 'Courses List Menu Item',
                    'icon'            => '',
                    'target'          => null,
                    'roles'           => '',
                    'order'           => 0
                ],

                 //quizzes
                [
                    'parent_id'       => $lms_frontend_menu,
                    'key'             => null,
                    'url'             => route('quizzes.index'),
                    'active_menu_url' => '/quizzes*',
                    'name'            => __('LMS::attributes.menu.quizzes'),
                    'description'     => 'Quizzes List Menu Item',
                    'icon'            => '',
                    'target'          => null,
                    'roles'           => '',
                    'order'           => 0
                ],
                                 //plans
                [
                    'parent_id'       => $lms_frontend_menu,
                    'key'             => null,
                    'url'             => route('plans.index'),
                    'active_menu_url' => '/packages*',
                    'name'            => __('LMS::attributes.menu.plans'),
                    'description'     => 'Plans List Menu Item',
                    'icon'            => '',
                    'target'          => null,
                    'roles'           => '',
                    'order'           => 0
                ],

                 //countact-us
                  [
                    'parent_id'       => $lms_frontend_menu,
                    'key'             => null,
                    'url'             => '/contact-us',
                    'active_menu_url' => '/contact-us*',
                    'name'            => __('LMS::attributes.menu.contact_us'),
                    'description'     => 'contact us List Menu Item',
                    'icon'            => '',
                    'target'          => null,
                    'roles'           => '',
                    'order'           => 0
                ],
                //about-us
                  [
                    'parent_id'       => $lms_frontend_menu,
                    'key'             => null,
                    'url'             => '/about-us',
                    'active_menu_url' => '/about-us*',
                    'name'            => __('LMS::attributes.menu.about_us'),
                    'description'     => 'about us List Menu Item',
                    'icon'            => '',
                    'target'          => null,
                    'roles'           => '',
                    'order'           => 0
                ],

            ]);

        // books
        $lms_menu_id = \DB::table('menus')->insertGetId([
            'parent_id'       => 1,// admin
            'key'             => null,
            'url'             =>  '/manage/books',
            'active_menu_url' => 'manage/books*',
            'name'            => 'Books',
            'description'     => 'Books Menu Item',
            'icon'            => 'fa fa-book',
            'target'          => null,
            'roles'           => '["1"]',
            'order'           => 0
        ]);

        //LMS Backend Menu



        $lms_menu_id = \DB::table('menus')->insertGetId([
            'parent_id'       => 1,// admin
            'key'             => 'lms',
            'url'             => null,
            'active_menu_url' => 'lms*',
            'name'            => 'LMS',
            'description'     => 'LMS Menu Item',
            'icon'            => 'fa fa-graduation-cap',
            'target'          => null,
            'roles'           => '["1"]',
            'order'           => 0
        ]);

        // seed users children menu
        \DB::table('menus')->insert([
                //Categories
                [
                    'parent_id'       => $lms_menu_id,
                    'key'             => null,
                    'url'             => config('lms.models.category.resource_url'),
                    'active_menu_url' => config('lms.models.category.resource_url') . '*',
                    'name'            => 'Categories',
                    'description'     => 'Categories List Menu Item',
                    'icon'            => 'fa fa-folder-open',
                    'target'          => null,
                    'roles'           => '["1"]',
                    'order'           => 0
                ],
                // Courses
                [
                    'parent_id'       => $lms_menu_id,
                    'key'             => null,
                    'url'             => config('lms.models.course.resource_url'),
                    'active_menu_url' => config('lms.models.course.resource_url') . '*',
                    'name'            => 'Courses',
                    'description'     => 'Courses List Menu Item',
                    'icon'            => 'fa fa-chalkboard-teacher',
                    'target'          => null,
                    'roles'           => '["1"]',
                    'order'           => 0
                ],
                [
                    'parent_id'       => $lms_menu_id,
                    'key'             => null,
                    'url'             => config('lms.models.lesson.resource_url'),
                    'active_menu_url' => config('lms.models.lesson.resource_url') . '*',
                    'name'            => 'Lessons',
                    'description'     => 'Lessons List Menu Item',
                    'icon'            => 'fa fa-book-open',
                    'target'          => null,
                    'roles'           => '["1"]',
                    'order'           => 0
                ],
                [
                    'parent_id'       => $lms_menu_id,
                    'key'             => null,
                    'url'             => config('lms.models.quiz.resource_url'),
                    'active_menu_url' => config('lms.models.quiz.resource_url') . '*',
                    'name'            => 'Quizzes',
                    'description'     => 'Quizzes List Menu Item',
                    'icon'            => 'fa fa-chess-clock',
                    'target'          => null,
                    'roles'           => '["1"]',
                    'order'           => 0
                ],
                 [
                    'parent_id'       => $lms_menu_id,
                    'key'             => null,
                    'url'             => config('lms.models.question.resource_url'),
                    'active_menu_url' => config('lms.models.question.resource_url') . '*',
                    'name'            => 'Questions',
                    'description'     => 'Questions List Menu Item',
                    'icon'            => 'fa fa-question-circle',
                    'target'          => null,
                    'roles'           => '["1"]',
                    'order'           => 0
                ],


                [
                    'parent_id'       => $lms_menu_id,
                    'key'             => null,
                    'url'             => config('lms.models.tag.resource_url'),
                    'active_menu_url' => config('lms.models.tag.resource_url') . '*',
                    'name'            => 'Tags',
                    'description'     => 'Tags List Menu Item',
                    'icon'            => 'fa fa-tags',
                    'target'          => null,
                    'roles'           => '["1"]',
                    'order'           => 0
                ],

                  [
                    'parent_id'       => $lms_menu_id,
                    'key'             => null,
                    'url'             => config('lms.models.plan.resource_url'),
                    'active_menu_url' => config('lms.models.plan.resource_url') . '*',
                    'name'            => 'Plans',
                    'description'     => 'Plans List Menu Item',
                    'icon'            => 'fa fa-plans',
                    'target'          => null,
                    'roles'           => '["1"]',
                    'order'           => 0
                ],

                [
                    'parent_id'       => $lms_menu_id,
                    'key'             => null,
                    'url'             => config('lms.models.invoice.resource_url'),
                    'active_menu_url' => config('lms.models.invoice.resource_url') . '*',
                    'name'            => 'invoices',
                    'description'     => 'invoices List Menu Item',
                    'icon'            => 'fa fa-plans',
                    'target'          => null,
                    'roles'           => '["1"]',
                    'order'           => 0
                ],

                [
                    'parent_id'       => $lms_menu_id,
                    'key'             => null,
                    'url'             => config('lms.models.subscription.resource_url'),
                    'active_menu_url' => config('lms.models.subscription.resource_url') . '*',
                    'name'            => 'subscriptions',
                    'description'     => 'subscriptions List Menu Item',
                    'icon'            => 'fa fa-subscriptions',
                    'target'          => null,
                    'roles'           => '["1"]',
                    'order'           => 0
                ],

                [
                    'parent_id'       => $lms_menu_id,
                    'key'             => null,
                    'url'             => config('lms.models.coupon_group.resource_url'),
                    'active_menu_url' => config('lms.models.coupon_group.resource_url') . '*',
                    'name'            => 'coupon_groups',
                    'description'     => 'coupon groups List Menu Item',
                    'icon'            => 'fa fa-plans',
                    'target'          => null,
                    'roles'           => '["1"]',
                    'order'           => 0
                ],


                 [
                    'parent_id'       => $lms_menu_id,
                    'key'             => null,
                    'url'             => config('lms.models.coupon.resource_url'),
                    'active_menu_url' => config('lms.models.coupon.resource_url') . '*',
                    'name'            => 'coupons',
                    'description'     => 'coupons List Menu Item',
                    'icon'            => 'fa fa-plans',
                    'target'          => null,
                    'roles'           => '["1"]',
                    'order'           => 0
                ],
                [
                    'parent_id'       => $lms_menu_id,
                    'key'             => null,
                    'url'             => config('lms.models.certificate.resource_url'),
                    'active_menu_url' => config('lms.models.certificate.resource_url') . '*',
                    'name'            => 'Certificates',
                    'description'     => 'Certificates List Menu Item',
                    'icon'            => 'fa fa-plans',
                    'target'          => null,
                    'roles'           => '["1"]',
                    'order'           => 0
                ],

                [
                    'parent_id'       => $lms_menu_id,
                    'key'             => null,
                    'url'             => config('lms.models.testimonial.resource_url'),
                    'active_menu_url' => config('lms.models.testimonial.resource_url') . '*',
                    'name'            => 'testimonials',
                    'description'     => 'testimonials List Menu Item',
                    'icon'            => 'fa fa-plans',
                    'target'          => null,
                    'roles'           => '["1"]',
                    'order'           => 0
                ],

            ]
        );
    }
}
