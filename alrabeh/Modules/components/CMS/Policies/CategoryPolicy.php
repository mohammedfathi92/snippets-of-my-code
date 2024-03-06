<?php

namespace Modules\Components\CMS\Policies;

use Modules\User\Models\User;
use Modules\Components\CMS\Models\Category;

class CategoryPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('CMS::category.view')) {
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
        return $user->can('CMS::category.create');
    }

    /**
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function update(User $user, Category $category)
    {
        if ($user->can('CMS::category.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Category $category
     * @return bool
     */
    public function destroy(User $user, Category $category)
    {
        if ($user->can('CMS::category.delete')) {
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
