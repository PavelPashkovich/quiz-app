@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row container justify-content-center vh-100 align-items-center">
            <div>
                <h1 class="text-center mb-4">{{ $quiz->title }}</h1>
            </div>
                <div class="col-6">
                    <h4 class="text-center">Correct answers</h4>
                    @if(count($quiz->questions) > 0)
                        <ol class="list-group list-group-numbered">

                            @foreach($quiz->questions as $question)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $question->text }}</div>
                                        @if($question->options->count() > 0)
                                            @foreach($question->options as $option)
                                                <div>
                                                    @if($option->is_correct)
                                                        <span class="text-success"><i class="bi bi-file-earmark-check fs-4"></i></span>
                                                    @else
                                                        <span class="text-danger"><i class="bi bi-file-earmark-excel fs-4"></i></span>
                                                    @endif
                                                    {{ $option->text }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
{{--                                    <span class="badge bg-primary rounded-pill">14</span>--}}
                                </li>
                            @endforeach

                        </ol>

                    @endif
                </div>
               <div class="col-6">
                   <h4 class="text-center">Your answers</h4>
                   @if(count($quiz->questions) > 0)
                       <ol class="list-group list-group-numbered">

                           @foreach($quiz->questions as $question)
                               <li class="list-group-item d-flex justify-content-between align-items-start">
                                   <div class="ms-2 me-auto">
                                       <div class="fw-bold">{{ $question->text }}</div>
                                       @if($question->options->count() > 0)
                                           @foreach($question->options as $option)
                                               <div>
{{--                                                   @if($option->is_correct)--}}
{{--                                                       <span class="text-success"><i--}}
{{--                                                               class="bi bi-file-earmark-check fs-4"></i></span>--}}
{{--                                                       {{ $option->text }}--}}
{{--                                                   @endif--}}
                                                   @foreach($results[$question->id] as $answerOptionId)
                                                           @if($option->id == $answerOptionId)
                                                               <span class="text-success"><i
                                                                       class="bi bi-file-earmark-check fs-4"></i></span>
                                                               {{ $option->text }}
                                                           @else
                                                               <span class="text-danger"><i class="bi bi-file-earmark-excel fs-4"></i></span>
                                                               {{ $option->text }}
                                                           @endif
                                                   @endforeach
                                               </div>
                                           @endforeach
                                       @endif
                                   </div>
{{--                                   <span class="badge bg-primary rounded-pill">14</span>--}}
                               </li>
                           @endforeach

                       </ol>

                   @endif
               </div>
            </div>
    </div>
@endsection
