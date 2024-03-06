<?php

namespace Modules\Components\LMS\Policies;

use Modules\User\Models\User;
use Modules\Components\LMS\Models\Quiz;

class QuizPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('LMS::quiz.view')) {
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
        return $user->can('LMS::quiz.create');
    }

    /**
     * @param User $user
     * @param Quiz $quiz
     * @return bool
     */
    public function update(User $user, Quiz $quiz)
    {
        if ($user->can('LMS::quiz.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Quiz $quiz
     * @return bool
     */
    public function destroy(User $user, Quiz $quiz)
    {
        if ($user->can('LMS::quiz.delete')) {
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
