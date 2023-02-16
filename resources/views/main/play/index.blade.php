@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center vh-100 align-items-center">
            <div class="col-xl-5 col-lg-7 col-md-9 col-sm-12">
                <div>
                    <h1 class="text-center mb-4">{{ $quiz->title }}</h1>
                </div>
                <div>
                    <h4 class="text-center mb-4">Press start to begin!</h4>
                </div>
                <div class="text-center">
                    <form action="{{ route('main.quizzes.play.question', ['quiz' => $quiz, 'number' => $number ?? 1]) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary px-4">Start</button>
                    </form>
{{--                    <a href="{{ route('main.quizzes.play.question', ['quiz' => $quiz, 'number' => $number ?? 1]) }}"><button class="btn btn-primary px-4">Start</button></a>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
