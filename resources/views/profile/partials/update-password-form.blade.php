<section>
    <form method="post" action="{{ route('password.update') }}" class="user">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password" class="small">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password"
                class="form-control form-control-user" autocomplete="current-password" />
            @error('current_password', 'updatePassword')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password" class="small">New Password</label>
            <input id="update_password_password" name="password" type="password" class="form-control form-control-user"
                autocomplete="new-password" />
            @error('password', 'updatePassword')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation" class="small">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="form-control form-control-user" autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Update Password
            </button>

            @if (session('status') === 'password-updated')
            <div class="alert alert-success text-center mt-3" role="alert">
                Password Updated Successfully.
            </div>
            @endif
        </div>
    </form>
</section>