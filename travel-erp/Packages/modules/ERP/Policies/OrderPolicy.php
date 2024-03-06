<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Order;

class OrderPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::order.view')) {
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
        return $user->can('ERP::order.create');
    }

    /**
     * @param User $user
     * @param Order $order
     * @return bool
     */
    public function update(User $user, Order $order)
    {
        if ($user->can('ERP::order.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param order $order
     * @return bool
     */
    public function destroy(User $user, Order $order)
    {
        if ($user->can('ERP::order.delete')) {
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
