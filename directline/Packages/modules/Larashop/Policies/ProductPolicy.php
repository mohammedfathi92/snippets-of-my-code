<?php

namespace Packages\Modules\Larashop\Policies;

use Packages\User\Models\User;
use Packages\Modules\Larashop\Models\Product;

class ProductPolicy
{

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('Larashop::product.view')) {
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
        return $user->can('Larashop::product.create');
    }

    /**
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function update(User $user, Product $product)
    {
        if ($user->can('Larashop::product.update')) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function destroy(User $user, Product $product)
    {
        if ($user->can('Larashop::product.delete')) {
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
