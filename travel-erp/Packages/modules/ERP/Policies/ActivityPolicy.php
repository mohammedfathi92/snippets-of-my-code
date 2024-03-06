<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Activity;

class ActivityPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::activity.view')) {
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
        return $user->can('ERP::activity.create');
    }

    /**
     * @param User $user
     * @param Activity $activity
     * @return bool
     */
    public function update(User $user, Activity $activity)
    {
        if ($user->can('ERP::activity.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param activity $activity
     * @return bool
     */
    public function destroy(User $user, Activity $activity)
    {
        if ($user->can('ERP::activity.delete')) {
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
