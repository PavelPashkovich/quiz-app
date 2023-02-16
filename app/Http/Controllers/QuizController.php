<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizStoreRequest;
use App\Http\Requests\QuizUpdateRequest;
use App\Models\Quiz;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class QuizController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function allQuizzes(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $quizzes = Quiz::where('is_published', true)->paginate(10);
        return view('main.quizzes.all', ['quizzes' => $quizzes]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function myQuizzes(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $userId = auth()->user()->getAuthIdentifier();
        $quizzes = Quiz::where('user_id', $userId)->paginate(10);
        return view('main.quizzes.my', ['quizzes' => $quizzes]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('main.quizzes.create');
    }


    /**
     * @param QuizStoreRequest $request
     * @return RedirectResponse
     */
    public function store(QuizStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->getAuthIdentifier();
        $data['is_published'] = false;
        $quiz = Quiz::create($data);
        return redirect()->route('main.quizzes.questions.index', ['quiz' => $quiz]);
    }

    /**
     * @param Quiz $quiz
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Quiz $quiz): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('main.quizzes.show', ['quiz' => $quiz]);
    }

    /**
     * @param Quiz $quiz
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Quiz $quiz): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if ($quiz->user->id != auth()->user()->getAuthIdentifier()) {
            abort(403);
        }
        return view('main.quizzes.edit', ['quiz' => $quiz]);
    }

    /**
     * @param QuizUpdateRequest $request
     * @param Quiz $quiz
     * @return RedirectResponse
     */
    public function update(QuizUpdateRequest $request, Quiz $quiz): RedirectResponse
    {
        $data = $request->validated();
        $quiz->update($data);
        return redirect()->route('main.quizzes.questions.index', ['quiz' => $quiz]);
    }

    /**
     * @param Quiz $quiz
     * @return RedirectResponse
     */
    public function destroy(Quiz $quiz): RedirectResponse
    {
        $quiz->delete();
        return redirect()->back();
    }

    /**
     * @param Quiz $quiz
     * @return RedirectResponse
     */
    public function togglePublishing(Quiz $quiz): RedirectResponse
    {
        foreach ($quiz->questions as $question) {
                if ($question->options()->where('is_correct', true)->count() == 0) {
                    return redirect()->back()->with('warning', 'Your answer options must have at list one correct answer.');
                }
        }
        $data['is_published'] = !$quiz->is_published;
        $quiz->update($data);
        if ($quiz->is_published) {
            Cache::store('redis')->tags(['quizzes'])->put($quiz->id, $quiz, now()->addDays(30));
        }
        return redirect()->back();
    }
}
