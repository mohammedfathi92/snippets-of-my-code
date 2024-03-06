<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Ferry;

class FerryPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::ferry.view')) {
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
        return $user->can('ERP::ferry.create');
    }

    /**
     * @param User $user
     * @param Ferry $ferry
     * @return bool
     */
    public function update(User $user, Ferry $ferry)
    {
        if ($user->can('ERP::ferry.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param ferry $ferry
     * @return bool
     */
    public function destroy(User $user, Ferry $ferry)
    {
        if ($user->can('ERP::ferry.delete')) {
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
