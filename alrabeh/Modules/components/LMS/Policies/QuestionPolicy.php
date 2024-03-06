<?php

namespace Modules\Components\LMS\Policies;

use Modules\User\Models\User;
use Modules\Components\LMS\Models\Question;

class QuestionPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('LMS::question.view')) {
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
        return $user->can('LMS::question.create');
    }

    /**
     * @param User $user
     * @param Question $question
     * @return bool
     */
    public function update(User $user, Question $question)
    {
        if ($user->can('LMS::question.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Question $question
     * @return bool
     */
    public function destroy(User $user, Question $question)
    {
        if ($user->can('LMS::question.delete')) {
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
