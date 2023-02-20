@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row container justify-content-center vh-100 align-items-center">
            <div>
                <h1 class="text-center mb-4">{{ $quiz->title }}</h1>
            </div>
                <div class="row col-8">
                    @if(count($quiz->questions) > 0)
                        <div class="col-6">
                            <h6 class="text-center">Correct answers</h6>
                        </div>
                        <div class="col-6">
                            <h6 class="text-center">Your answers</h6>
                        </div>
                        <ol class="list-group list-group-numbered">

                            @foreach($quiz->questions as $question)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="row col-12 ms-2 me-auto">
                                        <div class="fw-bold">{{ $question->text }}</div>
                                        <div class="row col-12">

                                            @if($question->options->count() > 0)

                                                <div class="col-6">
                                                    @foreach($question->options as $option)
                                                        <div>
                                                            @if($option->is_correct)
                                                                <span class="text-success"><i class="bi bi-file-earmark-check fs-4"></i></span>
                                                                @foreach($results[$question->id] as $answerOptionId)
                                                                    @if($option->id == $answerOptionId)
                                                                        <b>{{ $option->text }}</b>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <span class="text-danger"><i class="bi bi-file-earmark-excel fs-4"></i></span>
                                                                @foreach($results[$question->id] as $answerOptionId)
                                                                    @if($option->id == $answerOptionId)
                                                                        <b>{{ $option->text }}</b>
                                                                    @endif
                                                                @endforeach
                                                                {{ $option->text }}
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-6">
                                                    @foreach($question->options as $option)
                                                    @foreach($results[$question->id] as $answerOptionId)
                                                        <div>
                                                            @if($option->id == $answerOptionId)
                                                                @if($option->is_correct)
                                                                    <span class="text-success"><i
                                                                            class="bi bi-file-earmark-check fs-4"></i></span>
                                                                    <b>{{ $option->text }}</b>
                                                                @else
                                                                    <span class="text-danger"><i
                                                                            class="bi bi-file-earmark-excel fs-4"></i></span>
                                                                    {{ $option->text }}
                                                                @endif

{{--                                                            @else--}}
{{--                                                                <span class="text-danger"><i--}}
{{--                                                                        class="bi bi-file-earmark-excel fs-4"></i></span>--}}
                                                            @endif
{{--                                                                {{ $option->text }}--}}
                                                        </div>
                                                    @endforeach
                                                    @endforeach
                                                </div>

                                            @endif
                                        </div>

                                    </div>
{{--                                    <span class="badge bg-primary rounded-pill">14</span>--}}
                                </li>
                            @endforeach

                        </ol>

                    @endif
                </div>
            </div>
    </div>
@endsection
