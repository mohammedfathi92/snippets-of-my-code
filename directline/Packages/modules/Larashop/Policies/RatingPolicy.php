<?php

namespace Packages\Modules\Larashop\Policies;

use Packages\User\Models\User;

class RatingPolicy
{


    public function create(User $user)
    {
        return $user->can('Larashop::rating.create');
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
