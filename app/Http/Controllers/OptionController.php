<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionStoreRequest;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OptionController extends Controller
{
    /**
     * @param Question $question
     * @return Factory|View|Application
     * @throws AuthorizationException
     */
    public function index(Question $question): Factory|View|Application
    {
        $this->authorize('view', $question);
        return view('main.options.index', ['question' => $question]);
    }

    /**
     * @param Question $question
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create(Question $question): View|Factory|Application
    {
        $this->authorize('create', $question);
        return view('main.options.create', ['question' => $question]);
    }

    /**
     * @param OptionStoreRequest $request
     * @param Question $question
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function store(OptionStoreRequest $request, Question $question): View|Factory|Application
    {
        $this->authorize('create', $question);
        $data = $request->validated();
        $data['is_correct'] = (bool)$request->get('is_correct');
        $data['question_id'] = $question->id;
        Option::create($data);
        return view('main.options.index', ['question' => $question]);
    }

    /**
     * @param Option $option
     * @return RedirectResponse
     */
    public function destroy(Option $option): RedirectResponse
    {
        $option->delete();
        return redirect()->back();
    }
}
