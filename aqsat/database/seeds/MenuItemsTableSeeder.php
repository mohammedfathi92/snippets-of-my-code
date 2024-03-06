<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (file_exists(base_path('routes/web.php'))) {
            require base_path('routes/web.php');

            $menu = Menu::where('name', 'admin')->firstOrFail();

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'الرئيسية',
                'url'     => '',
                'route'   => 'voyager.dashboard',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-boat',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 1,
                ])->save();
            }


            //company links
            $companyMenuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'الشركة',
                'url'     => '',
            ]);
            if (!$companyMenuItem->exists) {
                $companyMenuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-home',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 2,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'المصروفات',
                'url'     => 'http://localhost:8000/admin/investors/pull/company/company_payments',
                'route'   => '',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-money',
                    'color'      => null,
                    'parent_id'  => $companyMenuItem->id,
                    'order'      => 3,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'بند جديد',
                'url'     => '',
                'route'   => 'targets.',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-money',
                    'color'      => null,
                    'parent_id'  => $companyMenuItem->id,
                    'order'      => 3,
                ])->save();
            }


            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'ايداع',
                'url'     => 'http://localhost:8000/admin/investors/deposit/company',
                'route'   => '',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-money',
                    'color'      => null,
                    'parent_id'  => $companyMenuItem->id,
                    'order'      => 3,
                ])->save();
            }


            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'سحب',
                'url'     => 'http://localhost:8000/admin/investors/pull/company',
                'route'   => '',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-money',
                    'color'      => null,
                    'parent_id'  => $companyMenuItem->id,
                    'order'      => 3,
                ])->save();
            }




















            //investors links
            $investorsMenuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'المستثمريين',
                'url'     => '',
            ]);
            if (!$investorsMenuItem->exists) {
                $investorsMenuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-users',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 2,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'قائمة المسثمريين',
                'url'     => '',
                'route'   => 'investors.',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-list',
                    'color'      => null,
                    'parent_id'  => $investorsMenuItem->id,
                    'order'      => 3,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'مستثمر جديد',
                'url'     => '',
                'route'   => 'investors.create',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-user-plus',
                    'color'      => null,
                    'parent_id'  => $investorsMenuItem->id,
                    'order'      => 4,
                ])->save();
            }


            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'ايداع',
                'url'     => '',
                'route'   => 'investors.deposit',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-money',
                    'color'      => null,
                    'parent_id'  => $investorsMenuItem->id,
                    'order'      => 5,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'سحب',
                'url'     => '',
                'route'   => 'investors.pull',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-money',
                    'color'      => null,
                    'parent_id'  => $investorsMenuItem->id,
                    'order'      => 6,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'عمليه تحويل',
                'url'     => '',
                'route'   => 'investors.transfer',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-money',
                    'color'      => null,
                    'parent_id'  => $investorsMenuItem->id,
                    'order'      => 7,
                ])->save();
            }



            //clients links
            $clientsMenuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'العملاء',
                'url'     => '',
            ]);
            if (!$clientsMenuItem->exists) {
                $clientsMenuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-users',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 8,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'قائمة العملاء',
                'url'     => '',
                'route'   => 'clients.',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-users',
                    'color'      => null,
                    'parent_id'  => $clientsMenuItem->id,
                    'order'      => 9,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'عميل جديد',
                'url'     => '',
                'route'   => 'clients.create',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-user-plus',
                    'color'      => null,
                    'parent_id'  => $clientsMenuItem->id,
                    'order'      => 10,
                ])->save();
            }



            //store links
            $storeMenuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'اداره المخزون',
                'url'     => '',
            ]);
            if (!$storeMenuItem->exists) {
                $storeMenuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-hdd-o',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 11,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'المخزون',
                'url'     => '',
                'route'   => 'store.',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-archive',
                    'color'      => null,
                    'parent_id'  => $storeMenuItem->id,
                    'order'      => 12,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'شراء سلعة',
                'url'     => '',
                'route'   => 'store.buy_product',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-shopping-cart',
                    'color'      => null,
                    'parent_id'  => $storeMenuItem->id,
                    'order'      => 13,
                ])->save();
            }


            //contracts links
            $contractsMenuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'العقود',
                'url'     => '',
            ]);
            if (!$contractsMenuItem->exists) {
                $contractsMenuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-hdd-o',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 14,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'اضافة عقد تقسيط',
                'url'     => 'admin/contracts/1/create',
                'route'   => '',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-pied-piper-pp',
                    'color'      => null,
                    'parent_id'  => $contractsMenuItem->id,
                    'order'      => 15,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'اضافه عقد اجل',
                'url'     => 'admin/contracts/2/create',
                'route'   => '',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-pied-piper-pp',
                    'color'      => null,
                    'parent_id'  => $contractsMenuItem->id,
                    'order'      => 16,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'العقود السارية',
                'url'     => '',
                'route'   => 'contracts.currently',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-suitcase',
                    'color'      => null,
                    'parent_id'  => $contractsMenuItem->id,
                    'order'      => 17,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'العقود المتعثرة',
                'url'     => '',
                'route'   => 'all_conflict',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-suitcase',
                    'color'      => null,
                    'parent_id'  => $contractsMenuItem->id,
                    'order'      => 18,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'العقود المتاخرة بالسداد',
                'url'     => '',
                'route'   => 'contracts.late_payment',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-suitcase',
                    'color'      => null,
                    'parent_id'  => $contractsMenuItem->id,
                    'order'      => 19,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'ارباح العقود',
                'url'     => '',
                'route'   => 'contracts.profits',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-suitcase',
                    'color'      => null,
                    'parent_id'  => $contractsMenuItem->id,
                    'order'      => 20,
                ])->save();
            }


            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => ' العقود الخالصة',
                'url'     => '',
                'route'   => 'contracts.pure',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-suitcase',
                    'color'      => null,
                    'parent_id'  => $contractsMenuItem->id,
                    'order'      => 21,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => ' الاقساط والدفعات',
                'url'     => '',
                'route'   => 'contracts.all_premiums',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-suitcase',
                    'color'      => null,
                    'parent_id'  => $contractsMenuItem->id,
                    'order'      => 22,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'عمولة العقد',
                'url'     => '',
                'route'   => 'contracts.all_profits',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-suitcase',
                    'color'      => null,
                    'parent_id'  => $contractsMenuItem->id,
                    'order'      => 23,
                ])->save();
            }


            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'الرسوم الادارية',
                'url'     => '',
                'route'   => 'contracts.',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-suitcase',
                    'color'      => null,
                    'parent_id'  => $contractsMenuItem->id,
                    'order'      => 24,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'الاقساط المتاخره',
                'url'     => '',
                'route'   => 'contracts.late_premium',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-suitcase',
                    'color'      => null,
                    'parent_id'  => $contractsMenuItem->id,
                    'order'      => 24,
                ])->save();
            }




//          financila transaction
            $contractsMenuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'المعاملات المالية',
                'url'     => '',
                'route'   => 'transaction.',
            ]);
            if (!$contractsMenuItem->exists) {
                $contractsMenuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-money',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 25,
                ])->save();
            }





            //--------------------------------


            //end investors

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'الميديا',
                'url'     => '',
                'route'   => 'voyager.media.index',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-images',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 26,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'المقالات',
                'url'     => '',
                'route'   => 'voyager.posts.index',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-news',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 27,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'المستخدميين',
                'url'     => '',
                'route'   => 'voyager.users.index',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-person',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 28,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'التصنيفات',
                'url'     => '',
                'route'   => 'voyager.categories.index',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-categories',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 29,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'الصفحات',
                'url'     => '',
                'route'   => 'voyager.pages.index',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-file-text',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 30,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'الصلاحيات',
                'url'     => '',
                'route'   => 'voyager.roles.index',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-lock',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 31,
                ])->save();
            }

            //tools

            $toolsMenuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'الادوات',
                'url'     => '',
            ]);
            if (!$toolsMenuItem->exists) {
                $toolsMenuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-tools',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 32,
                ])->save();
            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'القوائم',
                'url'     => '',
                'route'   => 'voyager.menus.index',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-list',
                    'color'      => null,
                    'parent_id'  => $toolsMenuItem->id,
                    'order'      => 33,
                ])->save();
            }

//            $menuItem = MenuItem::firstOrNew([
//                'menu_id' => $menu->id,
//                'title'   => 'Database',
//                'url'     => '',
//                'route'   => 'voyager.database.index',
//            ]);
//            if (!$menuItem->exists) {
//                $menuItem->fill([
//                    'target'     => '_self',
//                    'icon_class' => 'voyager-data',
//                    'color'      => null,
//                    'parent_id'  => $toolsMenuItem->id,
//                    'order'      => 34,
//                ])->save();
//            }
//
//            $menuItem = MenuItem::firstOrNew([
//                'menu_id' => $menu->id,
//                'title'   => 'Compass',
//                'url'     => '',
//                'route'   => 'voyager.compass.index',
//            ]);
//            if (!$menuItem->exists) {
//                $menuItem->fill([
//                    'target'     => '_self',
//                    'icon_class' => 'voyager-compass',
//                    'color'      => null,
//                    'parent_id'  => $toolsMenuItem->id,
//                    'order'      => 35,
//                ])->save();
//            }

            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'اعدادات الموقع',
                'url'     => '',
                'route'   => 'voyager.settings.index',
            ]);
            if (!$menuItem->exists) {
                $menuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'voyager-settings',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 36,
                ])->save();
            }


            //   group transaction
            $groupsMenuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'title'   => 'المجموعات',
                'url'     => '',
                'route'   => 'groups.',
            ]);
            if (!$groupsMenuItem->exists) {
                $groupsMenuItem->fill([
                    'target'     => '_self',
                    'icon_class' => 'fa fa-money',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 37,
                ])->save();
            }


        }
    }
}
