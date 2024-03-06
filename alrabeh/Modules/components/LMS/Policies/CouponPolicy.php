<?php

namespace Modules\Components\LMS\Policies;

use Modules\User\Models\User;
use Modules\Components\LMS\Models\Coupon;

class CouponPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('LMS::coupon.view')) {
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
        return $user->can('LMS::coupon.create');
    }

    /**
     * @param User $user
     * @param Coupon $coupon
     * @return bool
     */
    public function update(User $user, Coupon $coupon)
    {
        if ($user->can('LMS::coupon.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Coupon $coupon
     * @return bool
     */
    public function destroy(User $user, Coupon $coupon)
    {
        if ($user->can('LMS::coupon.delete')) {
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
