<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Year;

class YearPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::year.view')) {
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
        return $user->can('ERP::year.create');
    }

    /**
     * @param User $user
     * @param Year $year
     * @return bool
     */
    public function update(User $user, Year $year)
    {
        if ($user->can('ERP::year.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param year $year
     * @return bool
     */
    public function destroy(User $user, Year $year)
    {
        if ($user->can('ERP::year.delete')) {
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
