<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Airline;

class AirlinePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::airline.view')) {
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
        return $user->can('ERP::airline.create');
    }

    /**
     * @param User $user
     * @param Airline $airline
     * @return bool
     */
    public function update(User $user, Airline $airline)
    {
        if ($user->can('ERP::airline.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param airline $airline
     * @return bool
     */
    public function destroy(User $user, Airline $airline)
    {
        if ($user->can('ERP::airline.delete')) {
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
