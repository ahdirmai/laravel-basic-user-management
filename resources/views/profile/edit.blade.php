<x-app-layout>
    <x-slot name="title">{{ __('Profile') }}</x-slot>
    <x-slot name="header">{{ __('Profile') }}</x-slot>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Profile Information') }}</h6>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Update Password') }}</h6>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card shadow mb-4 border-danger">
                <div class="card-header py-3 bg-danger-light">
                    <h6 class="m-0 font-weight-bold text-danger">{{ __('Delete Account') }}</h6>
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>