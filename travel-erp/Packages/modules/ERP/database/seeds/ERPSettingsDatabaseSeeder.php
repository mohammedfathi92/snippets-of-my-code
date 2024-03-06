<?php

namespace Packages\Modules\ERP\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ERPSettingsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->insert([
            [
                'code' => 'erp_setting',
                'type' => 'TEXT',
                'category' => 'ERP',
                'label' => 'ERP setting',
                'value' => 'ERP Travel',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
