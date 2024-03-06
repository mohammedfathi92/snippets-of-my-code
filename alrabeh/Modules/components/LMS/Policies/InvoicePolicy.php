<?php

namespace Modules\Components\LMS\Policies;

use Modules\User\Models\User;
use Modules\Components\LMS\Models\Invoice;

class InvoicePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('LMS::invoice.view')) {
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
        return $user->can('LMS::invoice.create');
    }

    /**
     * @param User $user
     * @param Invoice $invoice
     * @return bool
     */
    public function update(User $user, Invoice $invoice)
    {
        if ($user->can('LMS::invoice.update')) {
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
        if ($user->can('LMS::invoice.delete')) {
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
