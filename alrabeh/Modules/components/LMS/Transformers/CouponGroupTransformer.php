<?php

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\BaseTransformer;
use Modules\Components\LMS\Models\Coupon;

class CouponGroupTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.coupon_group.resource_url');

        parent::__construct();
    }

    /**
     * @param Coupon $coupon_group
     * @return array
     * @throws \Throwable
     */
    public function transform(Coupon $coupon_group)
    {
        $coupon_group_status = $coupon_group->status;
        if ($coupon_group_status == "active") {
            $status = '<span class="label label-success">' . trans('LMS::attributes.coupon.status_options.active') . '</span>';
        } else if ($coupon_group_status == "pending") {
            $status = '<span class="label label-info">' . trans('LMS::attributes.coupon.status_options.pending') . '</span>';

        } else {
            $status = '<span class="label label-warning">' . trans('LMS::attributes.coupon.status_options.expired') . '</span>';
        }

        return [
            'id' => $coupon_group->id,
            'name' => $coupon_group->name,
            'value' => $coupon_group->type == "percentage" ? $coupon_group->value . "%" : $coupon_group->value.' ريال  ',
            // 'parent_id' => optional($coupon_group->parent)->name ?? '-',
            'type' => $coupon_group->type == "percentage"?'نسبة مئوية' : 'قيمة ثابتة',
            'start' => format_date($coupon_group->start),
            'status' => $status,
            'expiry' => format_date($coupon_group->expiry),
            'action' => $this->actions($coupon_group)
        ];


    }
}
