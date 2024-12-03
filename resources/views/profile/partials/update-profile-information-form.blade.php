<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="user" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name" class="small">Name</label>
            <input id="name" name="name" type="text"
                class="form-control form-control-user @error('name')is-invalid @enderror"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="small">Email</label>
            <input id="email" name="email" type="email"
                class="form-control form-control-user @error('email')is-invalid @enderror"
                value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2 text-muted">
                <p>
                    Your email address is unverified.
                    <button form="send-verification" class="btn btn-link p-0 text-primary align-baseline">
                        Click here to re-send the verification email.
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 text-success">
                    A new verification link has been sent to your email address.
                </p>
                @endif
            </div>
            @endif
        </div>

        <div class="form-group">
            <label for="nik" class="small">NIK</label>
            <input id="nik" name="nik" type="text"
                class="form-control form-control-user @error('nik')is-invalid @enderror"
                value="{{ old('nik', $user->nik) }}" autocomplete="off" />
            @error('nik')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="npwpd" class="small">NPWPD</label>
            <input id="npwpd" name="npwpd" type="text"
                class="form-control form-control-user @error('npwpd')is-invalid @enderror"
                value="{{ old('npwpd', $user->npwpd) }}" autocomplete="off" />
            @error('npwpd')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nohp" class="small">No. HP</label>
            <input id="nohp" name="nohp" type="tel"
                class="form-control form-control-user @error('nohp')is-invalid @enderror"
                value="{{ old('nohp', $user->nohp) }}" autocomplete="tel" />
            @error('nohp')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="fotopengguna" class="small">Foto Pengguna</label>
            <div class="custom-file mb-2">
                <input type="file" class="custom-file-input @error('fotopengguna')is-invalid @enderror"
                    id="fotopengguna" name="fotopengguna" onchange="previewImage(event)">
                <label class="custom-file-label" for="fotopengguna">
                    {{ $user->fotopengguna ? basename($user->fotopengguna) : 'Choose file' }}
                </label>
            </div>
            @error('fotopengguna')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror

            <div class="mt-2">
                <small>Preview:</small>
                <img id="preview" src="{{ $user->fotopengguna ? asset('storage/' . $user->fotopengguna) : '' }}"
                    alt="User Photo" class="img-thumbnail"
                    style="max-width: 200px; max-height: 200px; object-fit: cover;" />
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
            <div class="alert alert-success text-center mt-3" role="alert">
                Profile Updated Successfully.
            </div>
            @endif
        </div>
    </form>

    @push('scripts')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('preview');
                output.src = reader.result;

                // Update file label with selected filename
                const fileInput = event.target;
                const fileName = fileInput.files[0].name;
                fileInput.nextElementSibling.innerHTML = fileName;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        // Dynamically update file input label
        document.getElementById('fotopengguna').addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Choose file';
            this.nextElementSibling.innerHTML = fileName;
        });
    </script>
    @endpush
</section>