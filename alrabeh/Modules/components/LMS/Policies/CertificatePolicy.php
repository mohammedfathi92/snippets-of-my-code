<?php

namespace Modules\Components\LMS\Policies;

use Modules\User\Models\User;
use Modules\Components\LMS\Models\Certificate;

class CertificatePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('LMS::certificate.view')) {
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
        return $user->can('LMS::certificate.create');
    }

    /**
     * @param User $user
     * @param Certificate $certificate
     * @return bool
     */
    public function update(User $user, Certificate $certificate)
    {
        if ($user->can('LMS::certificate.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Certificate $certificate
     * @return bool
     */
    public function destroy(User $user, Certificate $certificate)
    {
        if ($user->can('LMS::certificate.delete')) {
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
