<?php

namespace Modules\Components\CMS\Observers;

use Modules\Components\CMS\Models\Category;

class CategoryObserver
{

    /**
     * @param Category $category
     */
    public function created(Category $category)
    {
    }
}
