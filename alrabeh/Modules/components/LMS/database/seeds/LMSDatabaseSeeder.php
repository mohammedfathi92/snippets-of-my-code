<?php

namespace Modules\Components\LMS\database\seeds;

use Modules\Menu\Models\Menu;
use Modules\Settings\Models\Setting;
use Modules\User\Models\Permission;
use Illuminate\Database\Seeder;

class LMSDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LMSPermissionsDatabaseSeeder::class);
        $this->call(LMSMenusDatabaseSeeder::class);
        $this->call(LMSSettingsDatabaseSeeder::class);
    }

    public function rollback()
    {
        Permission::where('name', 'like', 'LMS::%')->delete();


        $lms_menus = Menu::whereIn('key', ['lms'])->get();

        foreach ($lms_menus as $menu) {
            Menu::where('parent_id', $menu->id)->delete();
            $menu->delete();
        }
    }
}
