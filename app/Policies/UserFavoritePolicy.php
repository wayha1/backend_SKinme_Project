<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserFavorite;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserFavoritePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user favorite.
     */
    public function view(User $user, UserFavorite $userFavorite)
    {
        return $user->id === $userFavorite->user_id;
    }

    /**
     * Determine whether the user can update the user favorite.
     */
    public function update(User $user, UserFavorite $userFavorite)
    {
        return $user->id === $userFavorite->user_id;
    }

    /**
     * Determine whether the user can delete the user favorite.
     */
    public function delete(User $user, UserFavorite $userFavorite)
    {
        return $user->id === $userFavorite->user_id;
    }
}
