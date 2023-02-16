@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center vh-100 align-items-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-sm-12">
            <div>
                <h1 class="text-center mb-4">{{ $quiz->title }}</h1>
            </div>

            <div class="container d-inline-flex justify-content-between mb-2">
                <div>
                    <a class="nav-link" href="{{ route('main.quizzes.questions.create', ['quiz' => $quiz] )}}">
                        <button class="btn btn-primary">Create new question</button>
                    </a>
                </div>
                <div>
                    <a class="nav-link" href="{{ route('main.quizzes.show', ['quiz' => $quiz] )}}">
                        <button class="btn btn-info">Quiz preview</button>
                    </a>
                </div>
            </div>

            @if(count($quiz->questions) > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="text-center bg-light">
                        <tr>
                            <th class="text-center">Text</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-center align-middle">
                        @foreach($quiz->questions as $question)
                            <tr>
                                <td class="text-start">{{ $question->text }}</td>
                                <td>
                                    <div class="container d-inline-flex justify-content-center">

                                        @if($quiz->user->id === auth()->user()->getAuthIdentifier())
                                            <a href="{{ route('main.questions.options.index', $question)}}">
                                                <button class="btn btn-outline-warning m-1" type="button"><i
                                                        class="bi bi-pencil-square"></i> Add answer options
                                                    <span class="badge bg-warning rounded-pill">{{ $question->options->count() }}</span>
                                                </button>
                                            </a>
                                            <form role="form" class="form-container" action="{{ route('main.questions.destroy', $question) }}"
                                                  method="post">
                                                @method('delete')
                                                @csrf
                                                <button id="delete_one" class="btn btn-outline-danger m-1" type="submit"><i
                                                        class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
            <div>
                <h2 class="text-center mb-4">There are no questions yet.</h2>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
