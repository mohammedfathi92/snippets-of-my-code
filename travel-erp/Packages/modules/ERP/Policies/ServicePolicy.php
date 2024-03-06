<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Service;

class ServicePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::service.view')) {
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
        return $user->can('ERP::service.create');
    }

    /**
     * @param User $user
     * @param Service $service
     * @return bool
     */
    public function update(User $user, Service $service)
    {
        if ($user->can('ERP::service.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param service $service
     * @return bool
     */
    public function destroy(User $user, Service $service)
    {
        if ($user->can('ERP::service.delete')) {
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
