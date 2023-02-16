<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionStoreRequest;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    /**
     * @param Quiz $quiz
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(Quiz $quiz): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('main.questions.index', ['quiz' => $quiz]);
    }

    /**
     * @param Quiz $quiz
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Quiz $quiz): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('main.questions.create', ['quiz' => $quiz]);
    }

    /**
     * @param QuestionStoreRequest $request
     * @param Quiz $quiz
     * @return RedirectResponse
     */
    public function store(QuestionStoreRequest $request, Quiz $quiz): RedirectResponse
    {
        $data = $request->validated();
        $data['quiz_id'] = $quiz->id;
        Question::create($data);
        return redirect()->route('main.quizzes.questions.index', ['quiz' => $quiz]);
//        return view('main.questions.index', ['quiz' => $quiz]);
    }

    /**
     * @param Question $question
     * @return RedirectResponse
     */
    public function destroy(Question $question): RedirectResponse
    {
        $question->delete();
        return redirect()->back();
    }
}
