<?php

namespace Modules\Components\Payments\Policies;

use Modules\User\Models\User;
use Modules\Components\Payments\Models\Bar;

class BarPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('Payments::bar.view')) {
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
        return $user->can('Payments::bar.create');
    }

    /**
     * @param User $user
     * @param Bar $bar
     * @return bool
     */
    public function update(User $user, Bar $bar)
    {
        if ($user->can('Payments::bar.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Bar $bar
     * @return bool
     */
    public function destroy(User $user, Bar $bar)
    {
        if ($user->can('Payments::bar.delete')) {
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
