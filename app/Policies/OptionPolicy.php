<?php

namespace App\Policies;

use App\Models\Option;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Option $option
     * @return Response|bool
     */
    public function delete(User $user, Option $option): Response|bool
    {
        return $user->id === $option->question->quiz->user_id;
    }
}
