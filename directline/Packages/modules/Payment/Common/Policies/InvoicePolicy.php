<?php

namespace Packages\Modules\Payment\Policies;

use Packages\User\Models\User;
use Packages\Modules\Payment\Models\Invoice;

class InvoicePolicy
{

    /**
     * @param User $user
     * @param Invoice|null $invoice
     * @return bool
     */
    public function view(User $user, Invoice $invoice = null)
    {
        if ($user->can('Payment::invoice.view') && $invoice->user->id == $user->id) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->can('Subscriptions::invoice.create');
    }

    /**
     * @param User $user
     * @param Invoice $invoice
     * @return bool
     */
    public function update(User $user, Invoice $invoice)
    {
        if ($user->can('Subscriptions::invoice.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Invoice $invoice
     * @return bool
     */
    public function destroy(User $user, Invoice $invoice)
    {
        if ($user->can('Subscriptions::invoice.delete')) {
            return true;
        }
        return false;
    }


    /**
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if (isSuperUser($user)) {
            return true;
        }

        return null;
    }
}
