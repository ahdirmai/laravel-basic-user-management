<x-auth-layout>
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Forgot Your Password?</h1>
                            <p class="text-gray-600 mb-4">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will
                                email you a password reset link that will allow you to choose a new one.') }}
                            </p>
                        </div>

                        @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}" class="user">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group">
                                <input type="email"
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Enter Email Address..."
                                    value="{{ old('email') }}" required autofocus>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                {{ __('Email Password Reset Link') }}
                            </button>

                            <hr>

                            <!-- Back to Login -->
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">
                                    Already have an account? Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>