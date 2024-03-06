<?php

use Illuminate\Database\Seeder;
use App\PrintTemplate;

class PrintTemplatesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $contractTemp = PrintTemplate::firstOrNew([
            'type' => 'contract_1',
        ]);
        if (!$contractTemp->exists) {
            $contractTemp->fill([
                'content' => 'نموذج جديد',
            ])->save();
        }

        $contractTemp = PrintTemplate::firstOrNew([
            'type' => 'contract_2',
        ]);
        if (!$contractTemp->exists) {
            $contractTemp->fill([
                'content' => 'نموذج جديد',
            ])->save();
        }

         $qestTemp = PrintTemplate::firstOrNew([
            'type' => 'qest',
        ]);
        if (!$qestTemp->exists) {
            $qestTemp->fill([
                'content' => 'نموذج جديد',
            ])->save();
        }

          $buyTemp = PrintTemplate::firstOrNew([
            'type' => 'buy',
        ]);
        if (!$buyTemp->exists) {
            $buyTemp->fill([
                'content' => 'نموذج جديد',
            ])->save();
        }


        $depositTemp = PrintTemplate::firstOrNew([
            'type' => 'deposit',
        ]);
        if (!$depositTemp->exists) {
            $depositTemp->fill([
                'content' => 'نموذج جديد',
            ])->save();
        }

         $pullTemp = PrintTemplate::firstOrNew([
            'type' => 'pull',
        ]);
        if (!$pullTemp->exists) {
            $pullTemp->fill([
                'content' => 'نموذج جديد',
            ])->save();
        }

        $transTemp = PrintTemplate::firstOrNew([
            'type' => 'transfer',
        ]);
        if (!$transTemp->exists) {
            $transTemp->fill([
                'content' => 'نموذج جديد',
            ])->save();
        }

        $expTemp = PrintTemplate::firstOrNew([
            'type' => 'expenses',
        ]);
        if (!$expTemp->exists) {
            $expTemp->fill([
                'content' => 'نموذج جديد',
            ])->save();
        }

    }
}
