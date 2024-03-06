<?php

namespace Packages\Modules\ERP\database\seeds;

use Packages\Menu\Models\Menu;
use Packages\Settings\Models\Setting;
use Packages\User\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\Media;


class ERPDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ERPPermissionsDatabaseSeeder::class);
        $this->call(ERPMenuDatabaseSeeder::class);
        $this->call(ERPSettingsDatabaseSeeder::class);
        $this->call(ERPCategoriesDatabaseSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        
        
    }

    public function rollback()
    {
        Permission::where('name', 'like', 'ERP::%')->delete();

        Menu::where('key', 'erp_%')
            ->orWhere('active_menu_url', 'like', 'erp%')
            ->orWhere('url', 'like', 'erp%')
            ->delete();

        Setting::where('category', 'ERP')->delete();

        Media::whereIn('collection_name', ['erp-media-collection'])->delete();
    }
}
