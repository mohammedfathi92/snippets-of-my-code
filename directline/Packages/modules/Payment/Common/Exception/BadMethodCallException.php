<?php

namespace Packages\Modules\Payment\Common\Exception;

/**
 * Bad Method Call Exception
 */
class BadMethodCallException extends \BadMethodCallException implements PaymentException
{
}
