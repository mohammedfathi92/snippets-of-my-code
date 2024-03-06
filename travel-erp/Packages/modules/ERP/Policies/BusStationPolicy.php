<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\BusStation;

class BusStationPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::busstation.view')) {
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
        return $user->can('ERP::busstation.create');
    }

    /**
     * @param User $user
     * @param BusStation $busstation
     * @return bool
     */
    public function update(User $user, BusStation $busstation)
    {
        if ($user->can('ERP::busstation.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param busstation $busstation
     * @return bool
     */
    public function destroy(User $user, BusStation $busstation)
    {
        if ($user->can('ERP::busstation.delete')) {
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
