<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\FlightPrice;

class FlightPricePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::flightprice.view')) {
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
        return $user->can('ERP::flightprice.create');
    }

    /**
     * @param User $user
     * @param FlightPrice $flightprice
     * @return bool
     */
    public function update(User $user, FlightPrice $flight_price)
    {
        if ($user->can('ERP::flightprice.update') ) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param FlightPrice $flightprice
     * @return bool
     */
    public function destroy(User $user ,FlightPrice $flight_price)
    {
        if ($user->can('ERP::flightprice.delete') ) {
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
