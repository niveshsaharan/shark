<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScriptPolicy
{
    use HandlesAuthorization;

    public function view(Admin $user, Admin $resource)
    {
        return ($resource->isSuperAdmin() && $user->isSuperAdmin())
            || ($resource->isAdmin() && $user->isAdmin())
            || $user->is($resource)
            || $user->isAdmin();
    }

    public function viewAny(Admin $user)
    {
        return true;
    }

    public function create(Admin $user)
    {
        return $user->isAdmin();
    }

    public function update(Admin $user, Admin $resource)
    {
        return ($resource->isSuperAdmin() && $user->isSuperAdmin())
            || ($resource->isAdmin() && $user->isAdmin())
            || $user->is($resource)
            || $user->isAdmin();
    }

    public function delete(Admin $user, Admin $resource)
    {
        return ! $resource->isAdmin()
            && $user->isSuperAdmin();
    }

    public function restore(Admin $user, Admin $resource)
    {
        return $user->isSuperAdmin();
    }

    public function forceDelete(Admin $user, Admin $resource)
    {
        return false;
    }
}
