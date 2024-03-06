<?php

namespace Packages\Modules\Larashop\database\seeds;

use Carbon\Carbon;
use Packages\Menu\Models\Menu;
use Packages\Settings\Models\Setting;
use Packages\User\Models\Permission;
use Illuminate\Database\Seeder;

class LarashopDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LarashopPermissionsDatabaseSeeder::class);
        $this->call(LarashopMenuDatabaseSeeder::class);
        $this->call(LarashopDefaultsDatabaseSeeder::class);
        $this->call(LarashopNotificationTemplatesSeeder::class);

        \DB::table('settings')->insert([
            [
                'code' => 'supported_shipping_methods',
                'type' => 'SELECT',
                'category' => 'Larashop',
                'label' => 'Supported Shipping methods',
                'value' => json_encode(['FlatRate' => 'Flat Rate', 'Shippo' => 'Shippo']),
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

    }

    public function rollback()
    {
        Permission::where('name', 'like', 'Larashop%')->delete();
        Setting::where('code', 'supported_shipping_methods')->delete();

        $menus = Menu::where('key', 'ecommerce')->get();

        foreach ($menus as $menu) {
            Menu::where('parent_id', $menu->id)->delete();
            $menu->delete();
        }

        Setting::where('code', 'like', 'ecommerce_%')->delete();
    }
}
