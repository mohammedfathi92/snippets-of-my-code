<?php

use Packages\Modules\Payment\Common\database\migrations\CreateTaxablesTable;
use Packages\Modules\Payment\Common\database\migrations\CreateTaxesTable;
use Packages\Modules\Payment\Common\database\migrations\CreateTaxClassesTable;

if (!\Schema::hasTable('taxables') || !\Schema::hasTable('taxes') || !\Schema::hasTable('tax_classes')) {

    $migrations = [
        CreateTaxClassesTable::class,
        CreateTaxesTable::class,
        CreateTaxablesTable::class,
    ];

    foreach ($migrations as $migration) {
        try {
            $migrationObject = new $migration();
            $migrationObject->up();
        } catch (\Exception $exception) {

        }
    }
}

$payments_menu = \Packages\Menu\Models\Menu::where('key', 'payment')->first();

if ($payments_menu) {
    $payments_menu_id = $payments_menu->id;

    \Packages\Menu\Models\Menu::updateOrCreate(['parent_id' => $payments_menu_id, 'key' => 'payment-taxes'], [
        'url' => 'tax/tax-classes',
        'active_menu_url' => 'tax/tax-classes',
        'name' => 'Tax Classes',
        'description' => 'Tax Classes List Menu Item',
        'icon' => 'fa fa-cut',
        'target' => null, 'roles' => [1],
        'order' => 0
    ]);
}