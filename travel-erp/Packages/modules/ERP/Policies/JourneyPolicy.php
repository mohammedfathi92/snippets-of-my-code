<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Journey;

class JourneyPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::journey.view')) {
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
        return $user->can('ERP::journey.create');
    }

    /**
     * @param User $user
     * @param Journey $journey
     * @return bool
     */
    public function update(User $user, Journey $journey)
    {
        if ($user->can('ERP::journey.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param journey $journey
     * @return bool
     */
    public function destroy(User $user, Journey $journey)
    {
        if ($user->can('ERP::journey.delete')) {
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
