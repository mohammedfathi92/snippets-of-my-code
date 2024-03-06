<?php

namespace Modules\Components\LMS\Transformers;

use Modules\Foundation\Transformers\BaseTransformer;
use Modules\Components\LMS\Models\Coupon;

class CouponTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.coupon.resource_url');

        parent::__construct();
    }

    /**
     * @param Coupon $coupon
     * @return array
     * @throws \Throwable
     */
    public function transform(Coupon $coupon)
    {
        $coupon_status = $coupon->status;
        if ($coupon_status == "active") {
            $status = '<span class="label label-success">' . trans('LMS::attributes.coupon.status_options.active') . '</span>';
        } else if ($coupon_status == "pending") {
            $status = '<span class="label label-info">' . trans('LMS::attributes.coupon.status_options.pending') . '</span>';

        } else {
            $status = '<span class="label label-warning">' . trans('LMS::attributes.coupon.status_options.expired') . '</span>';
        }

        return [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'value' => $coupon->type == "percentage" ? $coupon->value . "%" : $coupon->value.' ريال  ',
            // 'parent_id' => optional($coupon->parent)->name ?? '-',
            'type' => $coupon->type == "percentage"?'نسبة مئوية' : 'قيمة ثابتة',
            'start' => format_date($coupon->start),
            'status' => $status,
            'expiry' => format_date($coupon->expiry),
            'parent_id'   => $coupon->parent?'<span class="label label-success"><i class="fa fa-folder-open"></i>'.'  '.$coupon->parent->name.'</span>':'لا يوجد',
            'action' => $this->actions($coupon)
        ];


    }
}
