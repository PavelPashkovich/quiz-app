@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row justify-content-center vh-100 align-items-center">
            <div class="text-center mb-2">
                <h1 class="text-center">{{ $results['quiz']->title }}</h1>
                <h2 class="text-center">Your result is {{ round($results['countCorrectAnswers'] / $results['countAllAnswers'] * 100) }}%</h2>
                <span class="text-center">({{ $results['countCorrectAnswers'] }} of {{ $results['countAllAnswers'] }} correct answers)</span>
            </div>

            <div class="row col-8">
                @if(count($results['quiz']->questions) > 0)
                    <div class="col-6">
                        <h6 class="text-center">Correct answers</h6>
                    </div>
                    <div class="col-6">
                        <h6 class="text-center">Your answers</h6>
                    </div>
                    <ol class="list-group list-group-numbered">

                        @foreach($results['quiz']->questions as $question)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="row col-12 ms-2 me-auto">
                                    <div class="fw-bold">{{ $question->text }}</div>
                                    <div class="row col-12">

                                        @if($question->options->count() > 0)

                                            <div class="col-6">
                                                @foreach($question->options as $option)
                                                    <div>
                                                        @if($option->is_correct)
                                                            <span class="text-success"><i
                                                                    class="bi bi-file-earmark-check fs-4"></i></span>
                                                            {{ $option->text }}
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="col-6">
                                                @if(empty($results['currentUserAnswers'][$question->id]))
                                                    No answer.
                                                @endif
                                                @foreach($question->options as $option)
                                                    @foreach($results['currentUserAnswers'][$question->id] as $answerOptionId)
                                                        <div>
                                                            @if($option->id == $answerOptionId)
                                                                @if($option->is_correct)
                                                                    <span class="text-success"><i
                                                                            class="bi bi-file-earmark-check fs-4"></i></span>
                                                                @else
                                                                    <span class="text-danger"><i
                                                                            class="bi bi-file-earmark-excel fs-4"></i></span>
                                                                @endif
                                                                {{ $option->text }}
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            </div>

                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </div>

        </div>
    </div>
@endsection
