<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Provider;

class ProviderPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::provider.view')) {
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
        return $user->can('ERP::provider.create');
    }

    /**
     * @param User $user
     * @param Provider $provider
     * @return bool
     */
    public function update(User $user, Provider $provider)
    {
        if ($user->can('ERP::provider.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param provider $provider
     * @return bool
     */
    public function destroy(User $user, Provider $provider)
    {
        if ($user->can('ERP::provider.delete')) {
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
