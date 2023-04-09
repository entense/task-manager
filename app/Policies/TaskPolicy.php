<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class TaskPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    public function update(User $user): bool
    {
        return $user->is_admin;
    }

    public function delete(User $user): bool
    {
        return $user->is_admin;
    }
}
