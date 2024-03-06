<?php

namespace Packages\Modules\Larashop\Observers;

use Packages\Modules\Larashop\Models\Product;

class ProductObserver
{

    /**
     * @param Product $product
     */
    public function created(Product $product)
    {
    }
}