<?php

namespace Modules\Components\LMS\Policies;

use Modules\User\Models\User;
use Modules\Components\LMS\Models\Testimonial;

class TestimonialPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('LMS::testimonial.view')) {
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
        return $user->can('LMS::testimonial.create');
    }

    /**
     * @param User $user
     * @param Testimonial $testimonial
     * @return bool
     */
    public function update(User $user, Testimonial $testimonial)
    {
        if ($user->can('LMS::testimonial.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Testimonial $testimonial
     * @return bool
     */
    public function destroy(User $user, Testimonial $testimonial)
    {
        if ($user->can('LMS::testimonial.delete')) {
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
