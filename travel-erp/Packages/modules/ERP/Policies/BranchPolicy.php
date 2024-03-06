<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Branch;

class BranchPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::branch.view')) {
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
        return $user->can('ERP::branch.create');
    }

    /**
     * @param User $user
     * @param Branch $branch
     * @return bool
     */
    public function update(User $user, Branch $branch)
    {
        if ($user->can('ERP::branch.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param branch $branch
     * @return bool
     */
    public function destroy(User $user, Branch $branch)
    {
        if ($user->can('ERP::branch.delete')) {
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
