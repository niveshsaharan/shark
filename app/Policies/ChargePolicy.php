<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Charge;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChargePolicy
{
    use HandlesAuthorization;

    public function view(Admin $user, Charge $resource)
    {
        return $user->isAdmin();
    }

    public function viewAny(Admin $user)
    {
        return $user->isAdmin();
    }

    public function create(Admin $user)
    {
        return false;
    }

    public function update(Admin $user, Charge $resource)
    {
        return false;
    }

    public function delete(Admin $user, Charge $resource)
    {
        return false;
    }

    public function restore(Admin $user, Charge $resource)
    {
        return false;
    }

    public function forceDelete(Admin $user, Charge $resource)
    {
        return false;
    }
}
