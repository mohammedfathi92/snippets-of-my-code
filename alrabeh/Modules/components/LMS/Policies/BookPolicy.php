<?php

namespace Modules\Components\LMS\Policies;

use Modules\User\Models\User;
use Modules\Components\LMS\Models\Book;

class BookPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('LMS::book.view')) {
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
        return $user->can('LMS::book.create');
    }

    /**
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function update(User $user, Book $book)
    {
        if ($user->can('LMS::book.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function destroy(User $user, Book $book)
    {
        if ($user->can('LMS::book.delete')) {
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
