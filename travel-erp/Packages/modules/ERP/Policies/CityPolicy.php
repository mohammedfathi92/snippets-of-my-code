<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\City;

class CityPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::city.view')) {
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
        return $user->can('ERP::city.create');
    }

    /**
     * @param User $user
     * @param City $city
     * @return bool
     */
    public function update(User $user, City $city)
    {
        if ($user->can('ERP::city.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param city $city
     * @return bool
     */
    public function destroy(User $user, City $city)
    {
        if ($user->can('ERP::city.delete')) {
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
