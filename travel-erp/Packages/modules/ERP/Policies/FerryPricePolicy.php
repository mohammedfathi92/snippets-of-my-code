<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\FerryPrice;

class FerryPricePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::ferryprice.view')) {
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
        return $user->can('ERP::ferryprice.create');
    }

    /**
     * @param User $user
     * @param FerryPrice $ferryprice
     * @return bool
     */
    public function update(User $user, FerryPrice $ferry_price)
    {
        if ($user->can('ERP::ferryprice.update') ) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param FerryPrice $ferryprice
     * @return bool
     */
    public function destroy(User $user ,FerryPrice $ferry_price)
    {
        if ($user->can('ERP::ferryprice.delete') ) {
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
