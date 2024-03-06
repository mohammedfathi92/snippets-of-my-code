<?php

namespace Modules\Components\CMS\database\seeds;

use Modules\Menu\Models\Menu;
use Modules\Settings\Models\Setting;
use Modules\User\Models\Permission;
use Illuminate\Database\Seeder;

class CMSDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CMSPermissionsDatabaseSeeder::class);
        $this->call(CMSMenusDatabaseSeeder::class);
        $this->call(CMSSettingsDatabaseSeeder::class);
    }

    public function rollback()
    {
        Permission::where('name', 'like', 'CMS::%')->delete();
        Setting::whereIn('code', ['home_page_slug', 'blog_page_slug', 'pricing_page_slug'])->delete();

        $cms_menus = Menu::whereIn('key', ['cms', 'frontend_top', 'frontend_footer'])->get();

        foreach ($cms_menus as $menu) {
            Menu::where('parent_id', $menu->id)->delete();
            $menu->delete();
        }
    }
}
