@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center vh-100 align-items-center">
        <div class="col-xl-6 col-lg-7 col-md-9 col-sm-11">
            <div>
                <h1 class="text-center mb-4">{{ $quiz->title }}
                    @if($quiz->is_published)
                        <span class="text-success"> <i class="bi bi-bookmark-check fs-4" title="Published"></i></span>
                    @else
                        <span class="text-danger"> <i class="bi bi-bookmark-x fs-4" title="Not published"></i></span>
                    @endif
                </h1>
            </div>

            <div class="container d-inline-flex justify-content-between mb-2">
                <div>
                    <a class="nav-link" href="{{ route('main.quizzes.edit', ['quiz' => $quiz] )}}">
                        <button class="btn btn-primary">Continue editing</button>
                    </a>
                </div>
                <div class="inline-flex">

                    @if($quiz->is_published)
                        <form action="{{ route('main.quizzes.togglePublishing', ['quiz' => $quiz] )}}" method="post">
                            @method('patch')
                            @csrf
                            <button class="btn btn-danger">Unpublish</button>
                        </form>
                    @else
                        <form action="{{ route('main.quizzes.togglePublishing', ['quiz' => $quiz] )}}" method="post">
                            @method('patch')
                            @csrf
                            <button class="btn btn-success">Publish</button>
                        </form>
                    @endif

                </div>
            </div>

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
                                @else
                                    No options yet.
                                @endif
                            </div>
                        </li>
                    @endforeach

                </ol>
            @else
            <div>
                <h2 class="text-center mb-4">There are no questions yet.</h2>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
