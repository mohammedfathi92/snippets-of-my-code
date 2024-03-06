<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\ActivityPrice;

class ActivityPricePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::activityprice.view')) {
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
        return $user->can('ERP::activityprice.create');
    }

    /**
     * @param User $user
     * @param ActivityPrice $activityprice
     * @return bool
     */
    public function update(User $user, ActivityPrice $activity_price)
    {
        if ($user->can('ERP::activityprice.update') ) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param ActivityPrice $activityprice
     * @return bool
     */
    public function destroy(User $user ,ActivityPrice $activity_price)
    {
        if ($user->can('ERP::activityprice.delete') ) {
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
