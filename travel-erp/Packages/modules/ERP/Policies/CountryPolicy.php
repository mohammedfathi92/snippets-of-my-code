<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Country;

class CountryPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::country.view')) {
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
        return $user->can('ERP::country.create');
    }

    /**
     * @param User $user
     * @param Country $country
     * @return bool
     */
    public function update(User $user, Country $country)
    {
        if ($user->can('ERP::country.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param country $country
     * @return bool
     */
    public function destroy(User $user, Country $country)
    {
        if ($user->can('ERP::country.delete')) {
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
