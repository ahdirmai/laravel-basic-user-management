<x-auth-layout>

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <!-- Left Side with Image -->
                <div class="col-lg-6 d-none d-lg-block bg-login-image"
                    style="background: url('{{ asset('img/1554147310.webp') }}') center/cover;"></div>

                <!-- Right Side with Form -->
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Selamat Datang Kembali!</h1>
                            <p class="mb-4">Masuk untuk melanjutkan ke akun Anda.</p>
                        </div>
                        <form method="POST" action="{{ route('login') }}" class="user">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group">
                                <input type="email"
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    id="email" name="email" aria-describedby="emailHelp"
                                    placeholder="Masukkan Alamat Email..." value="{{ old('email') }}" required autofocus
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
                                    id="password" name="password" placeholder="Kata Sandi" required
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
                                        Ingat Saya
                                    </label>
                                </div>
                            </div>

                            <!-- Login Button -->
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Masuk
                            </button>

                            <!-- Forgot Password -->
                            @if (Route::has('password.request'))
                            <div class="text-center mt-3">
                                <a class="small" href="{{ route('password.request') }}">
                                    Lupa Kata Sandi?
                                </a>
                            </div>
                            @endif

                            <hr>

                            <!-- Register Link -->
                            <div class="text-center">
                                <a class="small" href="{{ route('register') }}">
                                    Belum punya akun? Daftar di sini!
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>
