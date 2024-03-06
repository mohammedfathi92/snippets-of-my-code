<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 9:58 AM
 */

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\BaseTransformer;
use Modules\Components\LMS\Models\Testimonial;

class TestimonialTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.testimonial.resource_url');

        parent::__construct();
    }

    /**
     * @param Testimonial $testimonial
     * @return array
     * @throws \Throwable
     */
    public function transform(Testimonial $testimonial)
    {
         $show_url = url($this->resource_url . '/' . $testimonial->hashed_id);
        return [
            'id'      => $testimonial->id,
             'thumbnail'    =>  '<a href="' . $show_url . '">' . '<img src="' . $testimonial->thumbnail . '" class=" img-responsive" alt="testimonial Image" style="max-width: 50px;max-height: 50px;"/></a>',

            'title'   => str_limit($testimonial->title, 50),
            'user_name'   => $testimonial->user_name,
           
            'status' => formatStatusAsLabels($testimonial->status > 0?'active': 'inactive'),
            'updated_at' => \Carbon\Carbon::instance($testimonial->created_at)->diffForHumans(),
            'action' => $this->actions($testimonial)
        ];
    }
}