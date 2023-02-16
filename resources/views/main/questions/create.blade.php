@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center vh-100 align-items-center">
            <div class="col-xl-5 col-lg-7 col-md-9 col-sm-12">
                <div>
                    <h1 class="text-center mb-4">{{ $quiz->title }}</h1>
                </div>
                <div>
                    <h3 class="text-center mb-4">Create a new question!</h3>
                </div>
                <form action="{{ route('main.quizzes.questions.store', ['quiz' => $quiz]) }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="quizTitleInput">Question text</label>
                        <input type="text" class="form-control mb-2" id="quizTitleInput" name="text" placeholder="Question text">
                    </div>
                    @error('text')
                    <div class="text-danger">
                        <p><small>{{ $message }}</small></p>
                    </div>
                    @enderror

                    <button type="submit" class="btn btn-primary mt-2">Add question</button>
                </form>
            </div>
        </div>
    </div>
@endsection
