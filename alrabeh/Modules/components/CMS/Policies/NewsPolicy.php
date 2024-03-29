<?php
/**
 * Created by PhpStorm.
 * User: iMak
 * Date: 11/19/17
 * Time: 9:19 AM
 */

namespace Modules\Components\CMS\Policies;

use Modules\User\Models\User;
use Modules\Components\CMS\Models\News;

class NewsPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('CMS::news.view')) {
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
        return $user->can('CMS::news.create');
    }

    /**
     * @param User $user
     * @param News $news
     * @return bool
     */
    public function update(User $user, News $news)
    {
        if ($user->can('CMS::news.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param News $news
     * @return bool
     */
    public function destroy(User $user, News $news)
    {
        if ($user->can('CMS::news.delete')) {
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
