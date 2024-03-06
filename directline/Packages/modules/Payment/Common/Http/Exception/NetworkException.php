<?php

namespace Packages\Modules\Payment\Common\Http\Exception;

use Packages\Modules\Payment\Common\Http\Exception;
use Psr\Http\Client\Exception\NetworkException as PsrNetworkException;

class NetworkException extends Exception implements PsrNetworkException
{
}
