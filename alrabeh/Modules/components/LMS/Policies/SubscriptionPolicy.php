<?php

namespace Modules\Components\LMS\Policies;

use Modules\User\Models\User;
use Modules\Components\LMS\Models\Subscription;

class SubscriptionPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('LMS::subscription.view')) {
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
        return $user->can('LMS::subscription.create');
    }

    /**
     * @param User $user
     * @param Subscription $subscription
     * @return bool
     */
    public function update(User $user, Subscription $subscription)
    {
        if ($user->can('LMS::subscription.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Subscription $subscription
     * @return bool
     */
    public function destroy(User $user, Subscription $subscription)
    {
        if ($user->can('LMS::subscription.delete')) {
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
