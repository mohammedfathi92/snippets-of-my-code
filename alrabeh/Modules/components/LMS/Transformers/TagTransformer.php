<?php

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\BaseTransformer;
use Modules\Components\LMS\Models\Tag;

class TagTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.tag.resource_url');

        parent::__construct();
    }

    /**
     * @param Tag $tag
     * @return array
     * @throws \Throwable
     */
    public function transform(Tag $tag)
    {
        return [ 
            'id' => $tag->id,
            'name' => str_limit($tag->name, 50),
            'slug' => $tag->slug,
            'courses_count' => count($tag->courses),
            'status' => formatStatusAsLabels($tag->status > 0?'active': 'inactive'),
            'updated_at' => format_date($tag->updated_at),
            'action' => $this->actions($tag)
        ];
    }
}