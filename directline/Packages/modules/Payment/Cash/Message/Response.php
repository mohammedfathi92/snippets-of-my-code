<?php

namespace Packages\Modules\Payment\Cash\Message;

use Packages\Modules\Payment\Common\Message\AbstractResponse;

/**
 * Response
 */
class Response extends AbstractResponse
{


    public function isSuccessful()
    {
        return true;
    }

    /**
     * @return string
     */
    public function getCurrentPeriodEndReference()
    {
        return \Carbon\Carbon::now()->timestamp;

    }


}
