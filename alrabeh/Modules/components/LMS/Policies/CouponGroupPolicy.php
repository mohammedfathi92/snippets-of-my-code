<?php

namespace Modules\Components\LMS\Policies;

use Modules\User\Models\User;
use Modules\Components\LMS\Models\Coupon;

class CouponGroupPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('LMS::coupon_group.view')) {
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
        return $user->can('LMS::coupon_group.create');
    }

    /**
     * @param User $user
     * @param Coupon $coupon_group
     * @return bool
     */
    public function update(User $user, Coupon $coupon_group)
    {
        if ($user->can('LMS::coupon_group.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Coupon $coupon_group
     * @return bool
     */
    public function destroy(User $user, Coupon $coupon_group)
    {
        if ($user->can('LMS::coupon_group.delete')) {
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
