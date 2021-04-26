<?php

namespace App\Policies;

use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Status $status
     * @return mixed
     */
    public function update(User $user, Status $status): bool
    {
        return $user->id === $status->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Status $status
     * @return mixed
     */
    public function delete(User $user, Status $status): bool
    {
        return $user->id === $status->user_id;
    }
}
