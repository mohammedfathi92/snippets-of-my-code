<?php

namespace Modules\Components\Payments\database\seeds;

use Illuminate\Database\Seeder;

class PaymentsMenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => 1,// admin
            'key' => 'payments',
            'url' => null,
            'active_menu_url' => 'conversations*',
            'name' => 'Payments',
            'description' => 'Payments Menu Item',
            'icon' => 'fa fa-globe',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);

        // seed subscriptions children menu
        \DB::table('menus')->insert([
                [
                    'parent_id' => $payments_menu_id,
                    'key' => null,
                    'url' => config('payments.models.bar.resource_url'),
                    'active_menu_url' => config('payments.models.bar.resource_url') . '*',
                    'name' => 'Bars',
                    'description' => 'Bars List Menu Item',
                    'icon' => 'fa fa-cube',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]
        );
    }
}
