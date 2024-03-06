<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\BusPrice;

class BusPricePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::busprice.view')) {
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
        return $user->can('ERP::busprice.create');
    }

    /**
     * @param User $user
     * @param BusPrice $busprice
     * @return bool
     */
    public function update(User $user, BusPrice $busprice)
    {
        if ($user->can('ERP::busprice.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param busprice $busprice
     * @return bool
     */
    public function destroy(User $user, BusPrice $busprice)
    {
        if ($user->can('ERP::busprice.delete')) {
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
