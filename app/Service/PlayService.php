<?php

namespace App\Service;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\Statistic;

class PlayService
{
    /**
     * @param $userAnswers
     * @param Quiz $quiz
     * @return void
     */
    public function saveUserAnswers($userAnswers, Quiz $quiz): void
    {
        $lastAttempt = Answer::query()
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->where('quiz_id', $quiz->id)
            ->max('attempt');

        foreach ($userAnswers as $questionId => $options) {
            $data = [
                'user_answers' => $options[0],
                'attempt' => $lastAttempt ? $lastAttempt + 1 : 1,
                'user_id' => auth()->user()->getAuthIdentifier(),
                'quiz_id' => $quiz->id,
                'question_id' => $questionId,
            ];
            Answer::create($data);
        }
    }

    /**
     * @param $quiz
     * @return array
     */
    public function getPlayResults($quiz): array
    {
        $currentAttempt = Answer::query()
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->where('quiz_id', $quiz->id)
            ->max('attempt');

        $currentUserAnswersCollection = Answer::where('quiz_id', $quiz->id)
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->where('attempt', $currentAttempt)
            ->get();

        $correctAnswers = [];
        foreach ($quiz->questions as $question) {
            $correctAnswers[$question->id] = $question->options()->where('is_correct', true)->pluck('id')->toArray();
        }

        $currentUserAnswers = [];
        foreach ($currentUserAnswersCollection as $answer) {
            $currentUserAnswers[$answer->question_id] = $answer->user_answers;
        }

        $countCorrectAnswers = 0;
        $countAllAnswers = count($correctAnswers);
        foreach ($correctAnswers as $key => $value) {
            if ($value == $currentUserAnswers[$key]) {
                $countCorrectAnswers += 1;
            }
        }

        $data = [
            'user_id' => auth()->user()->getAuthIdentifier(),
            'quiz_id' => $quiz->id,
            'attempt' => $currentAttempt,
            'count_correct_answers' => $countCorrectAnswers,
            'count_all_answers' => $countAllAnswers,
        ];

        $this->saveResults($data);

        return [
            'quiz' => $quiz,
            'countCorrectAnswers' => $countCorrectAnswers,
            'countAllAnswers' => $countAllAnswers,
            'currentUserAnswers' => $currentUserAnswers
        ];
    }

    /**
     * @param $data
     * @return void
     */
    private function saveResults($data): void
    {
        Statistic::create($data);
    }
}
