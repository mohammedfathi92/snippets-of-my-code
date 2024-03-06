<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Expense;

class ExpensePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::expense.view')) {
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
        return $user->can('ERP::expense.create');
    }

    /**
     * @param User $user
     * @param Expense $expense
     * @return bool
     */
    public function update(User $user, Expense $expense)
    {
        if ($user->can('ERP::expense.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param expense $expense
     * @return bool
     */
    public function destroy(User $user, Expense $expense)
    {
        if ($user->can('ERP::expense.delete')) {
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
