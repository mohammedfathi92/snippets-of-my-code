<?php

namespace Packages\Modules\Larashop\Observers;

use Packages\Modules\Larashop\Models\SKU;

class SKUObserver
{

    /**
     * @param SKU $sku
     */
    public function created(SKU $sku)
    {
    }
}