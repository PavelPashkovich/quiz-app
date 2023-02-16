@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center vh-100 align-items-center">
            <div class="col-xl-5 col-lg-7 col-md-9 col-sm-12">
                <div>
                    <h1 class="text-center mb-4">Update quiz!</h1>
                </div>
                <form action="{{ route('main.quizzes.update', $quiz) }}" method="post">
                    @method('put')
                    @csrf

                    <div class="form-group">
                        <label for="quizTitleInput">Quiz title</label>
                        <input type="text" class="form-control mb-2" id="quizTitleInput" name="title" placeholder="Quiz title" value="{{ $quiz->title }}">
                    </div>
                    @error('title')
                    <div class="text-danger">
                        <p><small>{{ $message }}</small></p>
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="quizDescriptionInput">Description</label>
                        <textarea type="text" class="form-control mb-2" id="quizDescriptionInput" name="description" placeholder="Quiz description">{{ $quiz->description }}</textarea>
                    </div>
                    @error('description')
                    <div class="text-danger">
                        <p><small>{{ $message }}</small></p>
                    </div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Next step</button>
                </form>
            </div>
        </div>
    </div>
@endsection
