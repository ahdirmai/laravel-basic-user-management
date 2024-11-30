<x-auth-layout>

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                        </div>
                        <form method="POST" action="{{ route('login') }}" class="user">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group">
                                <input type="email"
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    id="email" name="email" aria-describedby="emailHelp"
                                    placeholder="Enter Email Address..." value="{{ old('email') }}" required autofocus
                                    autocomplete="username">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <input type="password"
                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Password" required
                                    autocomplete="current-password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="remember_me"
                                        name="remember">
                                    <label class="custom-control-label" for="remember_me">
                                        Remember Me
                                    </label>
                                </div>
                            </div>

                            <!-- Login Button -->
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Login
                            </button>

                            <!-- Forgot Password -->
                            @if (Route::has('password.request'))
                            <div class="text-center mt-3">
                                <a class="small" href="{{ route('password.request') }}">
                                    Forgot Password?
                                </a>
                            </div>
                            @endif

                            <hr>


                            <!-- Register Link -->
                            <div class="text-center">
                                <a class="small" href="{{ route('register') }}">
                                    Create an Account!
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>