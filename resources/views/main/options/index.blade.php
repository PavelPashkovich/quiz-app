@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center vh-100 align-items-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-sm-12">
            <div>
                <h1 class="text-center mb-4">{{ $question->text }}</h1>
            </div>
            <div>
                <a class="nav-link" href="{{ route('main.questions.options.create', ['question' => $question] )}}">
                    <button class="btn btn-primary mb-2">Create new option</button>
                </a>
            </div>
            @if(count($question->options) > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="text-center bg-light">
                        <tr>
                            <th class="text-center">Text</th>
                            <th class="text-center">Is correct?</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-center align-middle">
                        @foreach($question->options as $option)
                            <tr>
                                <td class="text-start">{{ $option->text }}</td>
                                <td class="text-center">
                                    @if($option->is_correct)
                                        <div class="text-success"><i class="bi bi-file-earmark-check fs-4"></i></div>
                                    @else
                                        <div class="text-danger"><i class="bi bi-file-earmark-excel fs-4"></i></div>
                                    @endif
                                </td>
                                <td>
                                    <div class="container d-inline-flex justify-content-center">

                                        @if($question->quiz->user->id === auth()->user()->getAuthIdentifier())
                                            <form role="form" class="form-container" action="{{ route('main.options.destroy', $option) }}"
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
                <h2 class="text-center mb-4">There are no options yet.</h2>
            </div>
            @endif
            <a href="{{ route('main.quizzes.questions.index', $question->quiz) }}">Back to questions</a>
        </div>

    </div>
</div>
@endsection
