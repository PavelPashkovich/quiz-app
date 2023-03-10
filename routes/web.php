<?php

use App\Http\Controllers\PlayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('main.index');

Route::middleware('auth')->group(function () {

    Route::prefix('/quizzes')->name('main.quizzes.')->group(function () {
        Route::get('/', [QuizController::class, 'allQuizzes'])->name('all');
        Route::get('/my', [QuizController::class, 'myQuizzes'])->name('my');
        Route::get('/create', [QuizController::class, 'create'])->name('create');
        Route::post('/', [QuizController::class, 'store'])->name('store');
        Route::get('/{quiz}', [QuizController::class, 'show'])->name('show');
        Route::get('/{quiz}/edit', [QuizController::class, 'edit'])->name('edit');
        Route::put('/{quiz}/update', [QuizController::class, 'update'])->name('update');
        Route::delete('/{quiz}', [QuizController::class, 'destroy'])->name('destroy');

        Route::patch('/{quiz}/toggle-publishing', [QuizController::class, 'togglePublishing'])->name('togglePublishing');
    });

    Route::prefix('/quizzes/{quiz}/play')->name('main.quizzes.play.')->group(function () {
        Route::get('/', [PlayController::class, 'index'])->name('index');
        Route::get('/results', [PlayController::class, 'getResults'])->name('getResults');
        Route::get('/{number}', [PlayController::class, 'playQuestion'])->name('playQuestion');
        Route::post('/{number}', [PlayController::class, 'saveAnswer'])->name('saveAnswer');
    });


    Route::name('main.')->group(function () {
        Route::get('/quizzes/{quiz}/questions', [QuestionController::class, 'index'])->name('quizzes.questions.index');
        Route::get('/quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('quizzes.questions.create');
        Route::post('/quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('quizzes.questions.store');
        Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
    });

    Route::name('main.')->group(function () {
        Route::get('/questions/{question}/options', [OptionController::class, 'index'])->name('questions.options.index');
        Route::get('/questions/{question}/options/create', [OptionController::class, 'create'])->name('questions.options.create');
        Route::post('/questions/{question}/options', [OptionController::class, 'store'])->name('questions.options.store');
        Route::delete('/options/{option}', [OptionController::class, 'destroy'])->name('options.destroy');
    });

    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

});

require __DIR__.'/auth.php';
Auth::routes();






//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');


//Route::get('/logout', [ProfileController::class, 'logout'])->name('profile.loqout');


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
