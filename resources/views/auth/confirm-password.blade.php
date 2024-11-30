<x-auth-layout>
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Confirm Password</h1>
                            <p class="text-gray-600 mb-4">
                                {{ __('This is a secure area of the application. Please confirm your password before
                                continuing.') }}
                            </p>
                        </div>

                        <form method="POST" action="{{ route('password.confirm') }}" class="user">
                            @csrf

                            <!-- Password -->
                            <div class="form-group">
                                <input type="password"
                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Enter your password" required
                                    autocomplete="current-password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Confirm
                            </button>

                            <hr>

                            <!-- Back to Previous Page -->
                            <div class="text-center">
                                <a href="javascript:history.back()" class="small">
                                    Go Back
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>