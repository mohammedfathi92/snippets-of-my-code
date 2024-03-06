<?php

namespace Modules\Components\Payments\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PaymentsSettingsDatabaseSeeder extends Seeder
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
                'code' => 'payments_setting',
                'type' => 'TEXT',
                'category' => 'Payments',
                'label' => 'Payments setting',
                'value' => 'payments',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
