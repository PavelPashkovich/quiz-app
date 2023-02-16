@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center vh-100 align-items-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-sm-12">
            @if(count($quizzes) > 0)
                <div>
                    <h1 class="text-center mb-4">Choose a quiz to play!</h1>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="text-center bg-light">
                        <tr>
                            <th class="text-start">Title</th>
                            <th class="text-start">Description</th>
                            <th>Questions</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-center align-middle">
                        @foreach($quizzes as $quiz)
                            <tr>
                                <td class="text-start">{{ $quiz->title }}</td>
                                <td class="text-start">{{ $quiz->description }}</td>
                                <td class="text-center"><span class="badge bg-primary rounded-pill">{{ $quiz->questions->count() }}</span></td>
                                <td>
                                    <div class="container d-inline-flex justify-content-center">
                                        <a href="{{ route('main.quizzes.play.index', ['quiz' => $quiz]) }}">
                                            <button class="btn btn-outline-primary m-1" type="button" title="Play"><i class="bi bi-play"></i></button>
                                        </a>

                                        @if($quiz->user->id === auth()->user()->getAuthIdentifier())
                                            <a href="{{ route('main.quizzes.edit', $quiz) }}">
                                                <button class="btn btn-outline-warning m-1" type="button" title="Edit"><i
                                                        class="bi bi-pencil-square"></i>
                                                </button>
                                            </a>
                                            <form role="form" class="form-container" action="{{ route('main.quizzes.destroy', $quiz) }}"
                                                  method="post">
                                                @method('delete')
                                                @csrf
                                                <button id="delete_one" class="btn btn-outline-danger m-1" type="submit" title="Delete"><i
                                                        class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                            @if($quiz->is_published)
                                                <form action="{{ route('main.quizzes.togglePublishing', ['quiz' => $quiz] )}}" method="post">
                                                    @method('patch')
                                                    @csrf
                                                    <button class="btn btn-link text-success" title="Click to unpublish"><i class="bi bi-bookmark-check fs-4"></i></button>
                                                </form>
                                            @else
                                                <form action="{{ route('main.quizzes.togglePublishing', ['quiz' => $quiz] )}}" method="post">
                                                    @method('patch')
                                                    @csrf
                                                    <button class="btn btn-link text-danger" title="Click to publish"><i class="bi bi-bookmark-x fs-4"></i></button>
                                                </form>
                                            @endif
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="m-auto">
                    {{ $quizzes->links() }}
                </div>
            @else
            <div>
                <h1 class="text-center mb-4">There are no quizzes yet.</h1>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
