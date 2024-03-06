<?php

namespace Packages\Modules\Larashop\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\Larashop\Models\Coupon;

class CouponTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('ecommerce.models.coupon.resource_url');

        parent::__construct();
    }

    /**
     * @param Coupon $coupon
     * @return array
     * @throws \Throwable
     */
    public function transform(Coupon $coupon)
    {
        $coupon_status = $coupon->status();
        if ($coupon_status == "active") {
            $status = '<span class="label label-success">' . trans('Larashop::attributes.coupon.status_options.active') . '</span>';
        } else if ($coupon_status == "pending") {
            $status = '<span class="label label-info">' . trans('Larashop::attributes.coupon.status_options.pending') . '</span>';

        } else {
            $status = '<span class="label label-warning">' . trans('Larashop::attributes.coupon.status_options.expired') . '</span>';
        }

        return [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'value' => $coupon->type == "percentage" ? $coupon->value . "%" : currency()->format($coupon->value, \Settings::get('admin_currency_code', 'USD')),
            'parent_id' => optional($coupon->parent)->name ?? '-',
            'type' => ucfirst($coupon->type),
            'start' => format_date($coupon->start),
            'status' => $status,
            'expiry' => format_date($coupon->expiry),
            'action' => $this->actions($coupon)
        ];


    }
}