<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Account;

class AccountPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::account.view')) {
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
        return $user->can('ERP::account.create');
    }

    /**
     * @param User $user
     * @param Account $account
     * @return bool
     */
    public function update(User $user, Account $account)
    {
        if ($user->can('ERP::account.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param account $account
     * @return bool
     */
    public function destroy(User $user, Account $account)
    {
        if ($user->can('ERP::account.delete')) {
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
