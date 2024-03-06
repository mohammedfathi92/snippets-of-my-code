<?php

namespace Packages\Modules\Payment\Common\Http\Exception;

use Packages\Modules\Payment\Common\Http\Exception;
use Psr\Http\Client\Exception\RequestException as PsrRequestException;

class RequestException extends Exception implements PsrRequestException
{
}
