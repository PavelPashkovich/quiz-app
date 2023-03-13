<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Question $question
     * @return Response|bool
     */
    public function view(User $user, Question $question): Response|bool
    {
        return $user->id === $question->quiz->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param Question $question
     * @return Response|bool
     */
    public function create(User $user, Question $question): Response|bool
    {
        return $user->id === $question->quiz->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Question $question
     * @return Response|bool
     */
    public function delete(User $user, Question $question): Response|bool
    {
        return $user->id === $question->quiz->user_id;
    }
}
