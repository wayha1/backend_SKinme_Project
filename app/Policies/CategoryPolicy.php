<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {    
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Category $category): bool 
    {
        return $user-> memberships -> contains($category);
    }
    public function create(): bool
    {
        return true;
    }
    public function update(User $user, Category $category): bool
    {
        return $user->id === $category;
    }
    public function delete(User $user, Category $category): bool
    {
        return $user->id === $category;
    }
    public function restore(): bool
    {
        return true;
    }
    public function forceDelete(): bool
    {
        return false;
    }
}
