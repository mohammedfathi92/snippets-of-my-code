<?php
/**
 * Fetch Issuers Response interface
 */

namespace Packages\Modules\Payment\Common\Message;

/**
 * Fetch Issuers Response interface
 *
 * This interface class defines the functionality of a response
 * that is a "fetch issuers" response.  It extends the ResponseInterface
 * interface class with some extra functions relating to the
 * specifics of a response to fetch the issuers from the gateway.
 * This happens when the gateway needs the customer to choose a
 * card issuer.
 *
 * @see ResponseInterface
 * @see Packages\Modules\Payment\Common\Issuer
 */
interface FetchIssuersResponseInterface extends ResponseInterface
{
    /**
     * Get the returned list of issuers.
     *
     * These represent banks which the user must choose between.
     *
     * @return \Packages\Modules\Payment\Common\Issuer[]
     */
    public function getIssuers();
}
