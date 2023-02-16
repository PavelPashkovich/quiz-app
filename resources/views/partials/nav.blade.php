    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="/">Quiz</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        @auth
                            <a class="nav-link" href="{{ route('main.quizzes.my') }}">My quizzes</a>
                            <a class="nav-link" href="{{ route('main.quizzes.all') }}">Choose a quiz</a>
                            <a class="nav-link" href="{{ route('main.quizzes.create') }}">Create new quiz</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>

                        @else
                            <a class="nav-link" href="{{ route('main.quizzes.all') }}">Choose a quiz</a>
                            <a href="{{ route('login') }}" class="nav-link">Log in</a>
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        @endauth

                    </div>
                </div>
            </div>
        </nav>
    </header>
