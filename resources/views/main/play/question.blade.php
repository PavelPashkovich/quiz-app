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

{{--                @if(isset($quiz->questions[$number]))--}}
                    <form action="{{ route('main.quizzes.play.question', ['quiz' => $quiz, 'number' => isset($quiz->questions[$number]) ? $number + 1 : 0]) }}" method="post">
                        @csrf
                        @if(count($quiz->questions[$number - 1]->options) > 0)
                            <ul class="list-group">
                                @foreach($quiz->questions[$number - 1]->options as $option)
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" name="answers[]" value="{{ $option->id }}" id="firstCheckboxStretched">
                                        {{ $option->text }}
                                    </li>
                                    <input type="hidden" name="question_id" value="{{ $quiz->questions[$number - 1]->id }}">
                                @endforeach
                            </ul>
                        @endif
                        <button class="btn btn-primary px-4 mt-2" type="submit">
                            {{ isset($quiz->questions[$number]) ? 'Submit' : 'Submit and get results' }}
                        </button>
                    </form>
{{--                @else--}}
{{--                    <form action="{{ route('main.quizzes.play.getResults', ['quiz' => $quiz]) }}" method="post">--}}
{{--                        @csrf--}}
{{--                        @if(count($quiz->questions[$number - 1]->options) > 0)--}}
{{--                            <ul class="list-group">--}}
{{--                                @foreach($quiz->questions[$number - 1]->options as $option)--}}
{{--                                    <li class="list-group-item">--}}
{{--                                        <input class="form-check-input me-1" type="checkbox" name="answers[]" value="{{ $option->text }}" id="firstCheckboxStretched">--}}
{{--                                        {{ $option->text }}--}}
{{--                                    </li>--}}
{{--                                    <input type="hidden" name="question_id" value="{{ $quiz->questions[$number - 1]->id }}">--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        @endif--}}
{{--                        <button class="btn btn-primary px-4 mt-2" type="submit">Submit and get results</button>--}}
{{--                    </form>--}}
{{--                @endif--}}


{{--                <div class="m-auto mt-4">--}}
{{--                    {{ $questions->links() }}--}}
{{--                </div>--}}
            </div>

        </div>
    </div>
@endsection
