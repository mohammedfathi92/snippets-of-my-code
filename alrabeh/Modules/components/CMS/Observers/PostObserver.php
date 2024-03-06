<?php

namespace Modules\Components\CMS\Observers;

use Modules\Components\CMS\Models\Post;

class PostObserver
{

    /**
     * @param Post $post
     */
    public function created(Post $post)
    {
    }
}
