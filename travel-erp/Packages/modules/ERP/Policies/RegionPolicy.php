<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Region;

class RegionPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::region.view')) {
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
        return $user->can('ERP::region.create');
    }

    /**
     * @param User $user
     * @param Region $region
     * @return bool
     */
    public function update(User $user, Region $region)
    {
        if ($user->can('ERP::region.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Region $region
     * @return bool
     */
    public function destroy(User $user, Region $region)
    {
        if ($user->can('ERP::region.delete')) {
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
