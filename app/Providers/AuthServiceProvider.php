<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Policies\OptionPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\QuizPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Quiz::class => QuizPolicy::class,
        Question::class => QuestionPolicy::class,
        Option::class => OptionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
