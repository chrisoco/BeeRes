<nav class="navbar navbar-expand-md navbar-dark bg-primary sticky-top mb-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">IPA</a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="">INDEX</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">

                @auth
                <li class="nav-item mx-5">
                    <span class="nav-link">{{ auth()->user()->email }}</span>
                </li>
                @endauth

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-gear"></i></i><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu mt-md-2" aria-labelledby="dropdown">

                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <input type="submit" class="dropdown-item" value="{{ __('Logout') }}">
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>



        </div>
    </div>
</nav>
