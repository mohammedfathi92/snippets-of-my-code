<?php

namespace Modules\Components\LMS\Observers;

use Modules\Components\LMS\Models\Category;

class CategoryObserver
{

    /**
     * @param Category $category
     */
    public function created(Category $category)
    {
    }
}