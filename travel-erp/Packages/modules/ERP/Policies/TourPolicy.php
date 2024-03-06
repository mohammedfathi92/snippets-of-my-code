<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Tour;

class TourPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::tour.view')) {
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
        return $user->can('ERP::tour.create');
    }

    /**
     * @param User $user
     * @param Tour $tour
     * @return bool
     */
    public function update(User $user, Tour $tour)
    {
        if ($user->can('ERP::tour.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param tour $tour
     * @return bool
     */
    public function destroy(User $user, Tour $tour)
    {
        if ($user->can('ERP::tour.delete')) {
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
