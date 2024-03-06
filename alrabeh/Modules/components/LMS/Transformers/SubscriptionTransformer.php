<?php

namespace Modules\Components\LMS\Transformers;


use Modules\Components\LMS\Models\Subscription;
use Modules\Foundation\Transformers\BaseTransformer;


class SubscriptionTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.subscription.resource_url');

        parent::__construct();
    }

    /**
     * @param Subscription $subscription
     * @return array
     * @throws \Throwable
     */
    public function transform(Subscription $subscription)
    {
        $actions = [];
        if (user()->hasPermissionTo('LMS::subscription.update')) {
            $actions['change_status'] = [
                'icon'  => 'fa fa-fw fa-edit',
                'href'  => url($this->resource_url . '/' . $subscription->hashed_id . '/change_status'), //this is url to load modal view
                'label' => trans('LMS::attributes.subscriptions.update_subscription_status'),
                'class' => 'modal-load',
                'data'  => [
                    'title' => trans('LMS::attributes.subscriptions.update_subscription_status')
                ]

            ];
        }

        $status_options = [
            'paid'      => __('LMS::attributes.subscriptions.paid'),
            'pending'   => __('LMS::attributes.subscriptions.pending'),
            'cancelled' => __('LMS::attributes.subscriptions.cancelled'),
        ];

        $subscribed_item = \LMS::getModuleData($subscription->subscriptionnable_type, $subscription->subscriptionnable_id);
        if ($subscribed_item) {
            $item_name = $subscribed_item->title;
        } else {
            $item_name = null;
        }

        $show_url = url($this->resource_url . '/' . $subscription->hashed_id);
        return [
            'id'         => $subscription->id,
            'user_name'       => $subscription->user_name,
            'item'       => $item_name,
            'item_type'  => __('LMS::attributes.main.elements_singular.' . $subscription->subscriptionnable_type),
            'status'     => formatStatusAsLabels($subscription->status > 0 ? 'active' : 'inactive'),
            'created_at' => format_date($subscription->created_at),
            // 'updated_at'   => format_date($subscription->updated_at),
            'action'     => $this->actions($subscription, $actions, null, false)
        ];
    }
}
