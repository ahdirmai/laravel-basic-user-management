<x-auth-layout>
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form method="POST" action="{{ route('register') }}" class="user">
                            @csrf

                            <!-- Name -->
                            <div class="form-group">
                                <input type="text"
                                    class="form-control form-control-user @error('name') is-invalid @enderror" id="name"
                                    name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus
                                    autocomplete="name">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="form-group">
                                <input type="email"
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Email Address" value="{{ old('email') }}"
                                    required autocomplete="username">
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
                                    autocomplete="new-password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <input type="password"
                                    class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation"
                                    placeholder="Confirm Password" required autocomplete="new-password">
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Register Button -->
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>

                            <hr>

                            <!-- Already Registered Link -->
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">
                                    Already have an account? Login!
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>