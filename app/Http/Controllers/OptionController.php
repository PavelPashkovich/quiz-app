<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionStoreRequest;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class OptionController extends Controller
{
    /**
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(Question $question): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('main.options.index', ['question' => $question]);
    }

    /**
     * @param Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Question $question): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('main.options.create', ['question' => $question]);
    }

    /**
     * @param OptionStoreRequest $request
     * @param Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(OptionStoreRequest $request, Question $question): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
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
