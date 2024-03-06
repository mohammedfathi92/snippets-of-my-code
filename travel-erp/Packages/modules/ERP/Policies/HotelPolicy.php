<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Hotel;

class HotelPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::hotel.view')) {
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
        return $user->can('ERP::hotel.create');
    }

    /**
     * @param User $user
     * @param Hotel $hotel
     * @return bool
     */
    public function update(User $user, Hotel $hotel)
    {
        if ($user->can('ERP::hotel.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param hotel $hotel
     * @return bool
     */
    public function destroy(User $user, Hotel $hotel)
    {
        if ($user->can('ERP::hotel.delete')) {
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
