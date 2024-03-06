<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\HotelPrice;

class HotelPricePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::hotelprice.view')) {
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
        return $user->can('ERP::hotelprice.create');
    }

    /**
     * @param User $user
     * @param HotelPrice $hotelprice
     * @return bool
     */
    public function update(User $user, HotelPrice $hotelprice)
    {
        if ($user->can('ERP::hotelprice.update') ) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param HotelPrice $hotelprice
     * @return bool
     */
    public function destroy(User $user ,HotelPrice $hotelprice)
    {
        if ($user->can('ERP::hotelprice.delete') ) {
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
