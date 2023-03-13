@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center vh-100 align-items-center">
            <div class="col-xl-5 col-lg-7 col-md-9 col-sm-12">
                <div class="text-center mb-2">
                    <h1>{{ $quiz->title }}</h1>
                </div>
                <div class="text-center mb-2">
                    <h3>{{ $quiz->questions[$number - 1]->text }}</h3>
                    <span >( Question {{ $number }} of {{ $quiz->questions->count() }} )</span>
                </div>

                    <form id="question-form" action="{{ route('main.quizzes.play.saveAnswer', ['quiz' => $quiz, 'number' => isset($quiz->questions[$number]) ? $number + 1 : 0]) }}" method="post">
                        @csrf
                        @if(count($quiz->questions[$number - 1]->options) > 0)
                            <ul class="list-group">
                                @foreach($quiz->questions[$number - 1]->options as $option)
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" name="answers[]" value="{{ $option->id }}" id="{{ $option->id }}CheckboxStretched">
                                        <label class="form-check-label stretched-link" for="{{ $option->id }}CheckboxStretched">{{ $option->text }}</label>
                                    </li>
                                    <input type="hidden" name="question_id" value="{{ $quiz->questions[$number - 1]->id }}">
                                @endforeach
                            </ul>
                        @endif
                        <button class="btn btn-primary px-4 mt-2" type="submit" onclick="resetTime()">
                            {{ isset($quiz->questions[$number]) ? 'Submit' : 'Submit and get results' }}
                        </button>

                    </form>

                <div id="timer"></div>

            </div>

        </div>
    </div>
@endsection

@vite(['resources/js/script.js'])
