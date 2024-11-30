<x-auth-layout>
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">{{ __('Verify Your Email') }}</h1>
                        </div>

                        <div class="mb-4 text-muted text-center">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by
                            clicking on the link we just emailed to you? If you didn\'t receive the email, we will
                            gladly send you another.') }}
                        </div>

                        @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success text-center mb-4">
                            {{ __('A new verification link has been sent to the email address you provided during
                            registration.') }}
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <form method="POST" action="{{ route('verification.send') }}" class="d-block">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Resend Verification Email') }}
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6 mb-3">
                                <form method="POST" action="{{ route('logout') }}" class="d-block">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-user btn-block">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>