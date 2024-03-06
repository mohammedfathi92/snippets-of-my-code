<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 9:58 AM
 */

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\BaseTransformer;
use Modules\Components\LMS\Models\Certificate;

class CertificateTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.certificate.resource_url');

        parent::__construct();
    }

    /**
     * @param Certificate $certificate
     * @return array
     * @throws \Throwable
     */
    public function transform(Certificate $certificate)
    {
         $show_url = url($this->resource_url . '/' . $certificate->hashed_id);
        return [
            'id'      => $certificate->id,
             'thumbnail'    =>  '<a href="' . $show_url . '">' . '<img src="' . $certificate->image . '" class=" img-responsive" alt="certificate Image" style="max-width: 50px;max-height: 50px;"/></a>',

            'title'   => str_limit($certificate->title, 50),
            'user_name'   => $certificate->user_name,
           
            'status' => formatStatusAsLabels($certificate->status > 0?'active': 'inactive'),
            'updated_at' => \Carbon\Carbon::instance($certificate->created_at)->diffForHumans(),
            'action' => $this->actions($certificate)
        ];
    }
}