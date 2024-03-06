<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Agent;

class AgentPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::agent.view')) {
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
        return $user->can('ERP::agent.create');
    }

    /**
     * @param User $user
     * @param Agent $agent
     * @return bool
     */
    public function update(User $user, Agent $agent)
    {
        if ($user->can('ERP::agent.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param agent $agent
     * @return bool
     */
    public function destroy(User $user, Agent $agent)
    {
        if ($user->can('ERP::agent.delete')) {
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
