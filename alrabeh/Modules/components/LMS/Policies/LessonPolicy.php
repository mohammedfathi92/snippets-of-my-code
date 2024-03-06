<?php

namespace Modules\Components\LMS\Policies;

use Modules\User\Models\User;
use Modules\Components\LMS\Models\Lesson;

class LessonPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('LMS::lesson.view')) {
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
        return $user->can('LMS::lesson.create');
    }

    /**
     * @param User $user
     * @param Lesson $lesson
     * @return bool
     */
    public function update(User $user, Lesson $lesson)
    {
        if ($user->can('LMS::lesson.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Lesson $lesson
     * @return bool
     */
    public function destroy(User $user, Lesson $lesson)
    {
        if ($user->can('LMS::lesson.delete')) {
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
