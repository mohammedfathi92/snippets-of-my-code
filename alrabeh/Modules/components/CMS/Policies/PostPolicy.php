<?php

namespace Modules\Components\CMS\Policies;

use Modules\User\Models\User;
use Modules\Components\CMS\Models\Post;

class PostPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('CMS::post.view')) {
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
        return $user->can('CMS::post.create');
    }

    /**
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function update(User $user, Post $post)
    {
        if ($user->can('CMS::post.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function destroy(User $user, Post $post)
    {
        if ($user->can('CMS::post.delete')) {
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
