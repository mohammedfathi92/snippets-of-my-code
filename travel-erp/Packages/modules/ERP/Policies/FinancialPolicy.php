<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Financial;

class FinancialPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::financial.view')) {
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
        return $user->can('ERP::financial.create');
    }

    /**
     * @param User $user
     * @param Financial $financial
     * @return bool
     */
    public function update(User $user, Financial $financial)
    {
        if ($user->can('ERP::financial.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param financial $financial
     * @return bool
     */
    public function destroy(User $user, Financial $financial)
    {
        if ($user->can('ERP::financial.delete')) {
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
