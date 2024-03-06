<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Vehicle;

class VehiclePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::vehicle.view')) {
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
        return $user->can('ERP::vehicle.create');
    }

    /**
     * @param User $user
     * @param Vehicle $vehicle
     * @return bool
     */
    public function update(User $user, Vehicle $vehicle)
    {
        if ($user->can('ERP::vehicle.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param vehicle $vehicle
     * @return bool
     */
    public function destroy(User $user, Vehicle $vehicle)
    {
        if ($user->can('ERP::vehicle.delete')) {
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
