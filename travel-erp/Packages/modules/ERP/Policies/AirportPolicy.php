<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Airport;

class AirportPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::airport.view')) {
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
        return $user->can('ERP::airport.create');
    }

    /**
     * @param User $user
     * @param Airport $airport
     * @return bool
     */
    public function update(User $user, Airport $airport)
    {
        if ($user->can('ERP::airport.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param airport $airport
     * @return bool
     */
    public function destroy(User $user, Airport $airport)
    {
        if ($user->can('ERP::airport.delete')) {
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
