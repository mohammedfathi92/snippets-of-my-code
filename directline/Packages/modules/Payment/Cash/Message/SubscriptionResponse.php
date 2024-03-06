<?php

namespace Packages\Modules\Payment\Cash\Message;

/**
 * SubscriptionResponse
 */
class SubscriptionResponse extends Response
{

    /**
     * @return string
     */
    public function getSubscriptionReference()
    {

        return $this->data['subscription_reference'];


    }


}
