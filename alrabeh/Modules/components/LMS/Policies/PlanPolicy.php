<?php

namespace Modules\Components\LMS\Policies;

use Modules\User\Models\User;
use Modules\Components\LMS\Models\Plan;

class PlanPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('LMS::plan.view')) {
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
        return $user->can('LMS::plan.create');
    }

    /**
     * @param User $user
     * @param Plan $plan
     * @return bool
     */
    public function update(User $user, Plan $plan)
    {
        if ($user->can('LMS::plan.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Plan $plan
     * @return bool
     */
    public function destroy(User $user, Plan $plan)
    {
        if ($user->can('LMS::plan.delete')) {
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
