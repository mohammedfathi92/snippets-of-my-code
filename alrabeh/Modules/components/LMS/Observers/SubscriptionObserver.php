<?php

namespace Modules\Components\LMS\Observers;

use Modules\Components\LMS\Models\Subscription;

class SubscriptionObserver
{

    /**
     * @param Subscription $subscription
     */
    public function created(Subscription $subscription)
    {
    }
}