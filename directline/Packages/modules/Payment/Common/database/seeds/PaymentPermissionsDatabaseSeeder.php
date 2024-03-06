<?php

namespace Packages\Modules\Payment\Common\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PaymentPermissionsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->insert([
            [
                'name' => 'Payment::settings.update',
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        \DB::table('permissions')->insert([
            [
                'name' => 'Payment::webhook.view',
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        \DB::table('permissions')->insert([
            [
                'name' => 'Payment::invoices.edit',
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
        \DB::table('permissions')->insert([
            [
                'name' => 'Payment::invoices.create',
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);


    }
}
