<?php

namespace Modules\Components\LMS\Observers;

use Modules\Components\LMS\Models\Invoice;

class InvoiceObserver
{

    /**
     * @param Invoice $invoice
     */
    public function created(Invoice $invoice)
    {
    }
}