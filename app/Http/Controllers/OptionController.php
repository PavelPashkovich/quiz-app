<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionStoreRequest;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OptionController extends Controller
{
    /**
     * @param Question $question
     * @return Factory|View|Application
     */
    public function index(Question $question): Factory|View|Application
    {
        return view('main.options.index', ['question' => $question]);
    }

    /**
     * @param Question $question
     * @return Application|Factory|View
     */
    public function create(Question $question): View|Factory|Application
    {
        return view('main.options.create', ['question' => $question]);
    }

    /**
     * @param OptionStoreRequest $request
     * @param Question $question
     * @return Application|Factory|View
     */
    public function store(OptionStoreRequest $request, Question $question): View|Factory|Application
    {
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
