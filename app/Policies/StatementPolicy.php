<?php

namespace App\Policies;

use App\Models\Statement;
use App\Models\User;

class StatementPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Statement $statement): bool
    {
        return $statement->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Statement $statement): bool
    {

        return $statement->user_id === $user->id;
    }
}
