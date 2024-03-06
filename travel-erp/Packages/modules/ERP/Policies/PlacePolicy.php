<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Place;

class PlacePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::place.view')) {
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
        return $user->can('ERP::place.create');
    }

    /**
     * @param User $user
     * @param Place $place
     * @return bool
     */
    public function update(User $user, Place $place)
    {
        if ($user->can('ERP::place.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param place $place
     * @return bool
     */
    public function destroy(User $user, Place $place)
    {
        if ($user->can('ERP::place.delete')) {
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
