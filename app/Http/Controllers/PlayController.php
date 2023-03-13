<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayRequest;
use App\Models\Quiz;
use App\Service\PlayService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class PlayController extends Controller
{
    /**
     * @param Quiz $quiz
     * @return Factory|View|Application
     */
    public function index(Quiz $quiz): Factory|View|Application
    {
        session()->forget('quiz');
        return view('main.play.index', ['quiz' => $quiz]);
    }

    /**
     * @param Quiz $quiz
     * @param $number
     * @return View|Factory|RedirectResponse|Application
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function playQuestion(Quiz $quiz, $number): View|Factory|RedirectResponse|Application
    {
        $answersCount = session()->get("quiz.$quiz->id") ? count(session()->get("quiz.$quiz->id")) : 0;
        if ($number <= $answersCount) {
            $number = $answersCount + 1;
            return redirect()->action([PlayController::class, 'playQuestion'], ['quiz' => $quiz, 'number' => $number]);
        }
        return view('main.play.question', ['quiz' => $quiz, 'number' => $number]);
    }

    /**
     * @param PlayRequest $request
     * @param Quiz $quiz
     * @param $number
     * @return View|Factory|RedirectResponse|Application
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function saveAnswer(PlayRequest $request, Quiz $quiz, $number): View|Factory|RedirectResponse|Application
    {
        Cache::store()->tags(['quizzes'])->add($quiz->id, $quiz, now()->addDays(10));
        $quiz = Cache::store('redis')->tags(['quizzes'])->get($quiz->id);

        $data = $request->validated();
        $questionId = $data['question_id'];
        $answers = $data['answers'] ?? [];

        if ($questionId) {
            $request->session()->push("quiz.$quiz->id.$questionId", $answers);
        }

        if (!$number) {
            return redirect()->route('main.quizzes.play.getResults', ['quiz' => $quiz]);
        }

        return $this->playQuestion($quiz, $number);
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

}
