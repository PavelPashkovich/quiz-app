<?php

namespace App\Policies;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class QuizPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Quiz $quiz
     * @return Response|bool
     */
    public function view(User $user, Quiz $quiz): Response|bool
    {
        return $user->id === $quiz->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param Quiz $quiz
     * @return bool
     */
    public function create(User $user, Quiz $quiz)
    {
        return $user->id === $quiz->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Quiz $quiz
     * @return Response|bool
     */
    public function update(User $user, Quiz $quiz): Response|bool
    {
        return $user->id === $quiz->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Quiz $quiz
     * @return Response|bool
     */
    public function delete(User $user, Quiz $quiz): Response|bool
    {
        return $user->id === $quiz->user_id;
    }
}
