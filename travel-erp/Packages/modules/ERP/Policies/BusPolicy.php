<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Bus;

class BusPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::bus.view')) {
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
        return $user->can('ERP::bus.create');
    }

    /**
     * @param User $user
     * @param Bus $bus
     * @return bool
     */
    public function update(User $user, Bus $bus)
    {
        if ($user->can('ERP::bus.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param bus $bus
     * @return bool
     */
    public function destroy(User $user, Bus $bus)
    {
        if ($user->can('ERP::bus.delete')) {
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
