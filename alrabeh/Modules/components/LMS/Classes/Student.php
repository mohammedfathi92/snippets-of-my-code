<?php

namespace Modules\Components\LMS\Classes;

use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\Logs;
use Modules\Components\LMS\Models\Plan;
use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Models\Subscription as SubscriptionLMS;
use Modules\Components\LMS\Models\UserLMS;
use Rinvex\Subscriptions\Models\PlanSubscription;

class Student
{
    /**
     * LMS constructor.
     */
    function __construct()
    {
    }


    /**
     * check if auth user is subscribed to item.
     */

    public function is_subscribed($options = [])
    {

        if ($options['module'] == 'plan') {

            $user = UserLMS::find($options['user']);

            $check_sub = $user->subscribedTo($options['module_id']);

            if ($check_sub) {
                return ['success' => true, 'status' => 1, 'message' => __('LMS::main.messages.subscriptions.user_subscribed')];

            }
            return ['success' => false, 'status' => 0, 'message' => __('LMS::main.messages.subscriptions.user_not_subscribed')];

        }


        $subscribed_items = Subscription::where('user_id', $options['user'])
            ->where('subscriptionnable_type', $options['module'])
            ->where('subscriptionnable_id', $options['module_id'])->where('status', '>', 0);

        if (!count($subscribed_items)) {
            return ['success' => false, 'status' => $subscribed_items->status, 'message' => __('LMS::main.messages.subscriptions.user_not_subscribed')];
        }

        // can subscribe [action => true]

        return ['success' => true, 'status' => $subscribed_items->status, 'message' => __('LMS::main.messages.subscriptions.user_subscribed')];

        /**
         * 0 => not subscribed,
         * 1 => is subscribed but subscription duration finnished,
         * 2 => is subscribed but subscription at pending mood,
         * 3 => is subscribed,
         */

    }


    /**
     * Do Subscription.
     */

    public function subscribe($options = [])
    {

        /**
         * status [
         * 0 => you sbscribed;
         * 1 => your plan timeout
         * 2 => your plan items finished
         * 3 => success
         * 4 => return view to booking
         *
         * ]
         */

        $user = UserLMS::find($options['user']);


        $data = $this->is_subscribed($options);


        if ($data['success']) {
            return $data;
        }

        $data = $this->check_plan($options);


        if ($data['success']) {

            $user_subscription = $data['user_subscription'];

            $plan = Plan::find($user_subscription->plan_id);

            $feature_slug = $plan->slug . '-' . str_plural($options['module']) . '-number';


            $canUseFeature = $user->subscription($user_subscription->slug)->canUseFeature($feature_slug);

            if ($canUseFeature) {

                // Increment by 1

                $user->subscription($user_subscription->slug)->recordFeatureUsage($feature_slug, 1);

                SubscriptionLMS::create([
                    'subscriptionnable_type' => $options['module'],
                    'subscriptionnable_id'   => $options['module_id'],
                    'user_id'                => $options[$user->id],
                    'plan_id'                => $user_subscription->plan_id,
                    'invoice_id'             => null,
                    'status'                 => true
                ]);
                return ['success' => true, 'status' => 3, 'message' => 'you subscribed to item'];


            } else {

                return ['success' => false, 'status' => 2, 'message' => 'your plan items finished'];

            }


        }

        //if not user has plan should buy new item

        return ['success' => false, 'status' => 4, 'message' => 'buy new items'];


    }

    public function check_plan($options = [])
    {

        $user = UserLMS::find($options['user']);

        $user_subscription = $this->userPlan($options['user']);

        if (!count($user_subscription)) {

            return ['success' => false, 'status' => 0, 'message' => 'user has plans'];

        }


        return ['success' => true, 'subscription' => $user_subscription, 'status' => 1, 'message' => 'user has plans'];


    }


    public function userPlan($user_id)
    {
        return PlanSubscription::where('user_id', $user_id)->first();
    }


    public function checkCoupon($options = [])
    {
        return PlanSubscription::where('user_id', $user_id)->first();
    }


    public function payment($options = [])
    {

        $coupon_code = '';

        if (isset($options['coupon_code']) && isset($options['coupon_code']) != null) {

            $coupon_code = $options['coupon_code'];

            $checkCoupon = $this->checkCoupon($options);

            if (!$checkCoupon['seccess']) {

                return $checkCoupon;
            }

        }

        switch ($options['module']) {
            case 'plan':
                $module_data = Plan::find($options['module_id']);
                break;
            case 'course':
                $module_data = Course::find($options['module_id']);
                break;
            case 'quiz':
                $module_data = Quiz::find($options['module_id']);
                break;

            default:
                return ['success' => false, 'status' => 0, 'message' => 'something happen'];
                break;
        }


        $invoice_data = [
            'code'        => $options['user'] . uniqid(),
            'currency'    => isset($options['currency']) ? $options['currency'] : 'SR',
            'description' => isset($options['description']) ? $options['description'] : '',
            'status'      => $coupon_code ? 'paid' : 'pending',
            'total_price' => $module_data->price,
            'used_coupon' => $coupon_code,
            'user_id'     => $options['user']

        ];

        $payment = Invoice::create($invoice_data);

        $invoice_items_data = [
            'code'                => $options['user'] . $payment->id . uniqid(),
            'currency'            => isset($options['currency']) ? $options['currency'] : 'SR',
            'description'         => isset($options['description']) ? $options['description'] : '',
            'status'              => $coupon_code ? 'paid' : 'pending',
            'price'               => $module_data->price,
            'paid'                => $module_data->price,
            'lms_invoicable_type' => $options['module'],
            'lms_invoicable_id'   => $options['module_id'],
            'invoice_id'          => $payment->id,
            'user_id'             => $options['user']

        ];

        $PaymentItems = InvoiceItem::create($invoice_items_data);

        return ['success' => true, 'invoice' => $payment->id, 'status' => $coupon_code ? 1 : 0, 'message' => 'you subscribe succefully'];

    }


    /**
     * check if user had been completed item
     *
     * @param array $attributes
     */

    public function enroll_status($attributes = [])
    {

        $lastItemLog = $this->lastItemLog($attributes);

        if ($lastItemLog) {

            //if not pass item

            if (!$lastItemLog->passed) {

                $data = ['success' => false, 'status' => 0, 'message' => 'not completed', 'itemLog' => $lastItemLog];
                return $data;


            } else {

                $data = ['success' => true, 'status' => 1, 'message' => ' completed', 'itemLog' => $lastItemLog];
                return $data;


            }

        }

        $data = ['success' => false, 'status' => 2, 'message' => 'not enrolled before'];
        return $data;
    }


    /**
     * mark as completed
     *
     * @param array $attributes
     */

    public function completed($attributes = [])
    {

        $resposn = $this->enroll_status($attributes);
        if ($resposn['success']) {

            return ['success' => true, 'status' => 1, 'message' => $resposn['message']];

        }


        $user = $attributes['user'];
        $data =
            $user->logs->where('lms_loggable_type', $attributes['module'])->where('lms_loggable_id', $attributes['module_id'])
                ->where('parent_id', $attributes['parent'])->update([
                'status' => 1,
                'passed' => isset($attributes['passed']) ? $attributes['passed'] : false
            ]);
         return $data;
    }


    /**
     * mark as uncompleted
     *
     * @param array $attributes
     */

    public function uncompleted($attributes = [])
    {
        return [];
    }


    /**
     * check if user can enroll [log into] items
     *
     * @param array $attributes
     */

    public function can_enroll($attributes = [])
    {

        $data = ['success' => true, 'status' => 1, 'message' => 'you can enroll this course'];
        return $data;
    }


    /**
     * check if user enrolled  [logged into] items before;
     *
     * @param array $attributes
     */

    public function is_enrolled($attributes = [])
    {

        $data = ['success' => true, 'status' => 1, 'message' => 'you enrolled this before'];
        return $data;
    }


    /**
     * user enroll [log into] items
     *
     * @param array $attributes , bool $retake
     */


    public function enroll($attributes = [])
    {

        $enroll_status = $this->enroll_status($attributes);

        $user = $attributes['user'];

        $parentId = null;

        $parentPassed = true;

        //if not enrolled before


        if (isset($attributes['parent']) && !empty($attributes['parent'])) {

            $parentLog = $this->lastItemLog([
                'user'      => $user,
                'module'    => $attributes['parent']['type'],
                'module_id' => $attributes['parent']['id'],
                'parent'    => []
            ]);

            if ($parentLog) {
                $parentId = $parentLog->id;
                $parentPassed = $parentLog->passed;
            }


        }

        if ($enroll_status['status'] == 2) {

            $enroll = true;
        } elseif ($enroll_status['status'] == 1 && $parentPassed) {
            $enroll = true;
        } else {
            $enroll = false;
        }

        if ($enroll) {
            $itemLog = Logs::create([
                'user_id'           => $user->id,
                'lms_loggable_type' => $attributes['module'],
                'lms_loggable_id'   => $attributes['module_id'],
                'parent_id'         => $parentId
            ]);

            return ['success' => true, 'status' => 1, 'message' => 'create new user log for this item', 'itemLog' => $itemLog];

        }

        $itemLog = isset($enroll_status['itemLog']) ? $enroll_status['itemLog'] : null;

        $itemLog->update(['enrolls_number' => $itemLog->enrolls_number + 1]);

        return ['success' => true, 'status' => 1, 'message' => 'create new user log for this item', 'itemLog' => $itemLog];
    }

    /**
     * user progress in this item
     *
     * @param array $attributes
     * @return array finished | remaining | percentage
     */

    public function progress($attributes = [])
    {
        return [];
    }


    /**
     * last user log for specific item ifo
     *
     * @param array $attributes
     * @return $itemLog
     */


    public function lastItemLog($attributes = [])
    {

        $user = $attributes['user'];
        $itemLog = null;

        if (isset($attributes['parent']) && !empty($attributes['parent'])) {
            $parent_type = $attributes['parent']['type'];
            $parent_id = $attributes['parent']['id'];


            $itemLog = Logs::where('user_id', $user->id)->where('lms_loggable_type', $attributes['module'])
                ->where('lms_loggable_id', $attributes['module_id'])->whereHas('parent', function ($q) use ($parent_type, $parent_id) {
                    $q->where('lms_loggable_type', $parent_type)->where('lms_loggable_id', $parent_id);

                })->orderBy('id', 'desc')->first();

            if ($itemLog) {

                return ['log_id' => $itemLog->id, 'parent_log' => $itemLog->parent_id];

            }


        }


        $itemLog = Logs::where('user_id', $user->id)->where('lms_loggable_type', $attributes['module'])->where('lms_loggable_id', $attributes['module_id'])->orderBy('id', 'desc')->first();

        if ($itemLog) {

            return $itemLog;

        }

        return $itemLog;

    }

    /**
     * logsNumber for item
     *
     * @param array $attributes , bool $parent
     * $parent [only logs for item that has this parent]
     * @return logsNumber for item
     */

    public function logsNumber($attributes = [], $parent = false)
    {

        $user = $attributes['user'];

        if ($parent) {

            $parent_type = $attributes['parent']['type'];
            $parent_id = $attributes['parent']['id'];

            $number = $user->logs->where('lms_loggable_type', $attributes['module'])
                ->where('lms_loggable_id', $attributes['module_id'])->whereHas('parent', function ($q) use ($parent_type, $parent_id) {
                    $q->where('lms_loggable_type', $parent_type)->where('lms_loggable_id', $parent_id);

                })->count();

            return $number;


        }

        $number = $user->logs->where('lms_loggable_type', $attributes['module'])->where('lms_loggable_id', $attributes['module_id'])->count();

        return $number;


    }


}
