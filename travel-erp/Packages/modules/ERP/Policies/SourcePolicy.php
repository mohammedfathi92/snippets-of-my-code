<?php

namespace Packages\Modules\ERP\Policies;

use Packages\User\Models\User;
use Packages\Modules\ERP\Models\Source;

class SourcePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('ERP::source.view')) {
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
        return $user->can('ERP::source.create');
    }

    /**
     * @param User $user
     * @param Source $source
     * @return bool
     */
    public function update(User $user, Source $source)
    {
        if ($user->can('ERP::source.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param source $source
     * @return bool
     */
    public function destroy(User $user, Source $source)
    {
        if ($user->can('ERP::source.delete')) {
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
