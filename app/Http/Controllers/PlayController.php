<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayRequest;
use App\Models\Answer;
use App\Models\Quiz;
use App\Service\PlayService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PlayController extends Controller
{
    /**
     * @param Quiz $quiz
     * @return Factory|View|Application
     */
    public function index(Quiz $quiz): Factory|View|Application
    {
        return view('main.play.index', ['quiz' => $quiz]);
    }

    /**
     * @param PlayRequest $request
     * @param Quiz $quiz
     * @param $number
     * @return Application|Factory|View|RedirectResponse
     */
    public function play(PlayRequest $request, Quiz $quiz, $number): View|Factory|RedirectResponse|Application
    {
        Cache::store()->tags(['quizzes'])->add($quiz->id, $quiz, now()->addDays(10));
        $quiz = Cache::store('redis')->tags(['quizzes'])->get($quiz->id);

        if ($number == 1) {
            $request->session()->forget('quiz');
        }

        $data = $request->validated();
        $questionId = $data['question_id'] ?? null;
        $answers = $data['answers'] ?? [];

        if ($questionId) {
            $request->session()->push("quiz.$quiz->id.$questionId", $answers);
        }

        if (!$number) {
            return redirect()->route('main.quizzes.play.getResults', ['quiz' => $quiz]);
        }
        return view('main.play.question', ['quiz' => $quiz, 'number' => $number]);
    }

    /**
     * @param Request $request
     * @param Quiz $quiz
     * @param PlayService $service
     * @return Factory|View|Application
     */
    public function getResults(Request $request, Quiz $quiz, PlayService $service): Factory|View|Application
    {
        Cache::store()->tags(['quizzes'])->add($quiz->id, $quiz, now()->addDays(10));
        $quiz = Cache::store('redis')->tags(['quizzes'])->get($quiz->id);

        $userAnswers = $request->session()->get("quiz.$quiz->id");
        $service->saveUserAnswers($userAnswers, $quiz);

        $results = $service->getPlayResults($quiz);

        return view('main.play.results', ['results' => $results]);
    }

//    public function seeResults(Quiz $quiz) {
//        $currentAttempt = Answer::query()
//            ->where('user_id', auth()->user()->getAuthIdentifier())
//            ->where('quiz_id', $quiz->id)
//            ->max('attempt');
//
//        $currentUserAnswersCollection = Answer::where('quiz_id', $quiz->id)
//            ->where('user_id', auth()->user()->getAuthIdentifier())
//            ->where('attempt', $currentAttempt)
//            ->get();
//        $results = [];
//        foreach ($currentUserAnswersCollection as $answer) {
//            $results[$answer->question_id] = $answer->user_answers;
//        }
//
//        return view('main.play.seeResults', ['quiz' => $quiz, 'results' => $results]);
//    }
}
