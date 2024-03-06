<?php

namespace Modules\Components\CMS\Policies;

use Modules\User\Models\User;
use Modules\Components\CMS\Models\Page;

class PagePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('CMS::page.view')) {
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
        return $user->can('CMS::page.create');
    }

    /**
     * @param User $user
     * @param Page $page
     * @return bool
     */
    public function update(User $user, Page $page)
    {
        if ($user->can('CMS::page.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Page $page
     * @return bool
     */
    public function destroy(User $user, Page $page)
    {
        if ($user->can('CMS::page.delete')) {
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
