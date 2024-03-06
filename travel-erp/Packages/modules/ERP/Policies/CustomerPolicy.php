<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\UserErp;

class CustomerPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::customer.view')) {
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
        return $user->can('ERP::customer.create');
    }

    /**
     * @param User $user
     * @param Account $customer
     * @return bool
     */
    public function update(User $user, UserErp $customer)
    {
        if ($user->can('ERP::customer.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param customer $customer
     * @return bool
     */
    public function destroy(User $user, UserErp $customer)
    {
        if ($user->can('ERP::customer.delete')) {
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
