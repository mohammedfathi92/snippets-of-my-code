<?php

namespace Modules\Components\Payments\database\seeds;

use Modules\Menu\Models\Menu;
use Modules\Settings\Models\Setting;
use Modules\User\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\Media;

class PaymentsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaymentsPermissionsDatabaseSeeder::class);
        $this->call(PaymentsMenuDatabaseSeeder::class);
        $this->call(PaymentsSettingsDatabaseSeeder::class);
    }

    public function rollback()
    {
        Permission::where('name', 'like', 'Payments::%')->delete();

        Menu::where('key', 'payments')
            ->orWhere('active_menu_url', 'like', 'paymentss%')
            ->orWhere('url', 'like', 'paymentss%')
            ->delete();

        Setting::where('category', 'Payments')->delete();

        Media::whereIn('collection_name', ['payments-media-collection'])->delete();
    }
}
