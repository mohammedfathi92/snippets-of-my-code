<?php

namespace Packages\Modules\ERP\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ERPCategoriesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // {"en":"uncategorized","ar":"غير مصنف "}
    public function run()
    {
        \DB::table('erp_categories')->insert([
            [
                'name' => json_encode(['en' => 'Uncategorized','ar' => 'غير مصنف']),
                'slug' => 'uncategorized',
                'status' => true,
                'type' => 'general',
            ]
            
        ]);
    }
}
