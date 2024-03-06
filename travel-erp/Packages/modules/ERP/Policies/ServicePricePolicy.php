<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\ServicePrice;

class ServicePricePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::serviceprice.view')) {
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
        return $user->can('ERP::serviceprice.create');
    }

    /**
     * @param User $user
     * @param ServicePrice $serviceprice
     * @return bool
     */
    public function update(User $user, ServicePrice $service_price)
    {
        if ($user->can('ERP::serviceprice.update') ) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param ServicePrice $serviceprice
     * @return bool
     */
    public function destroy(User $user ,ServicePrice $service_price)
    {
        if ($user->can('ERP::serviceprice.delete') ) {
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
