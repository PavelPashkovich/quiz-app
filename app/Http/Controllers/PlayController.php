<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayRequest;
use App\Models\Quiz;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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

    public function play(PlayRequest $request, Quiz $quiz, $number)
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

//        session()->flush();
        dump(session()->all());
        if (!$number) {
            return redirect()->route('main.quizzes.play.getResults', ['quiz' => $quiz]);
        }
        return view('main.play.question', ['quiz' => $quiz, 'number' => $number]);
    }

    public function getResults(Request $request, Quiz $quiz)
    {
        Cache::store()->tags(['quizzes'])->add($quiz->id, $quiz, now()->addDays(10));
        $quiz = Cache::store('redis')->tags(['quizzes'])->get($quiz->id);

        $userAnswers = $request->session()->get("quiz.$quiz->id");

        foreach ($userAnswers as $questionId => $options) {
            foreach ($options[0] as $option) {
                dump("$questionId - $option");
            }
        }

        dd($userAnswers);

//        $correctAnswers = [];
//        foreach ($quiz->questions as $question) {
//            $correctAnswers[$question->id] = $question->options()->where('is_correct', true)->get('text')->toArray();
//        }
//        dump($correctAnswers);
//
//        $userAnswers = $request->session()->get("quiz.$quiz->id");
//        dump($userAnswers);
//
//        $scores = 0;
//        foreach ($userAnswers as $key => $value) {
//            dump(array_values($correctAnswers[$key][0]) == array_values($value[0]));
//            if (array_values($correctAnswers[$key][0]) == array_values($value[0])) {
//                $scores += 10;
//            }
//        }
//        dd($scores);
    }
}
