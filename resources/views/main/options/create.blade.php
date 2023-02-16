@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center vh-100 align-items-center">
            <div class="col-xl-5 col-lg-7 col-md-9 col-sm-12">
                <div>
                    <h1 class="text-center mb-4">{{ $question->text }}</h1>
                </div>
                <div>
                    <h3 class="text-center mb-4">Create a new option!</h3>
                </div>
                <form action="{{ route('main.questions.options.store', ['question' => $question]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="quizTitleInput">Option text</label>
                        <input type="text" class="form-control mb-2" id="quizTitleInput" name="text" placeholder="Option text">
                        @error('text')
                        <div class="text-danger">
                            <p><small>{{ $message }}</small></p>
                        </div>
                        @enderror

                        <label for="quizCheckboxInput">Is this the correct answer?</label>
                        <input type="checkbox" class="form-check-input" id="quizCheckboxInput" name="is_correct">
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Add option</button>
                </form>
            </div>
        </div>
    </div>
@endsection
