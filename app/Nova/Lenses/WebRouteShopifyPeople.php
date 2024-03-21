<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(Admin $user, User $resource)
    {
        return $user->isAdmin();
    }

    public function viewAny(Admin $user)
    {
        return $user->isAdmin();
    }

    public function create(Admin $user)
    {
        return $user->isAdmin();
    }

    public function update(Admin $user, User $resource)
    {
        return $user->isAdmin();
    }

    public function delete(Admin $user, User $resource)
    {
        return false;
    }

    public function restore(Admin $user, User $resource)
    {
        return false;
    }

    public function forceDelete(Admin $user, User $resource)
    {
        return false;
    }
}
