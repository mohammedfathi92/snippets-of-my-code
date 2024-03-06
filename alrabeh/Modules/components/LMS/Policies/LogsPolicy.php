<?php

namespace Modules\Components\LMS\Policies;

use Modules\User\Models\User;
use Modules\Components\LMS\Models\Logs;

class LogsPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('LMS::logs.view')) {
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
        return $user->can('LMS::logs.create');
    }

    /**
     * @param User $user
     * @param Logs $logs
     * @return bool
     */
    public function update(User $user, Logs $logs)
    {
        if ($user->can('LMS::logs.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Logs $logs
     * @return bool
     */
    public function destroy(User $user, Logs $logs)
    {
        if ($user->can('LMS::logs.delete')) {
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
