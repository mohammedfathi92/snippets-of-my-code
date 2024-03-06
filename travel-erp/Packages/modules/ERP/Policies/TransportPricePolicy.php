<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\TransportPrice;

class TransportPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::transportprice.view')) {
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
        return $user->can('ERP::transportprice.create');
    }

    /**
     * @param User $user
     * @param TransportPrice $transprot_price
     * @return bool
     */
    public function update(User $user, TransportPrice $transportprice)
    {
        if ($user->can('ERP::transportprice.update') ) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param TransportPrice $transprot_price
     * @return bool
     */
    public function destroy(User $user ,TransportPrice $transprotprice)
    {
        if ($user->can('ERP::transprotprice.delete') ) {
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
