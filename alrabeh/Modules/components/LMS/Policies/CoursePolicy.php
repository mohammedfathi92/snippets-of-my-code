<?php

namespace Modules\Components\LMS\Policies;

use Modules\User\Models\User;
use Modules\Components\LMS\Models\Course;

class CoursePolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('LMS::course.view')) {
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
        return $user->can('LMS::course.create');
    }

    /**
     * @param User $user
     * @param Course $course
     * @return bool
     */
    public function update(User $user, Course $course)
    {
        if ($user->can('LMS::course.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Course $course
     * @return bool
     */
    public function destroy(User $user, Course $course)
    {
        if ($user->can('LMS::course.delete')) {
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
