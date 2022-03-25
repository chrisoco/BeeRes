<div class="row justify-content-center">
    <div class="col-md-12 col-lg-8">
        @error('email')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error</strong> E-Mail Address or Password is wrong!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @enderror
        <div class="card">
            <div class="card-header text-center"><h4>Login</h4></div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-form-label">E-Mail Address</label>

                        <div class="col">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-form-label">Password</label>

                        <div class="col">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mb-2">Login</button>

                    <a href="{{ route('register') }}" class="btn btn-secondary btn-block mb-2">Register</a>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                </form>
            </div>
        </div>
    </div>
</div>

