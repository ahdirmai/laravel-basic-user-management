<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="user" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Existing name and email fields -->
        <div class="form-group">
            <label for="name" class="small">Name</label>
            <input id="name" name="name" type="text" class="form-control form-control-user"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="small">Email</label>
            <input id="email" name="email" type="email" class="form-control form-control-user"
                value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
            <small class="text-danger">{{ $message }}</small>
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

        <!-- New fields added -->
        <div class="form-group">
            <label for="nik" class="small">NIK</label>
            <input id="nik" name="nik" type="text" class="form-control form-control-user"
                value="{{ old('nik', $user->nik) }}" autocomplete="off" />
            @error('nik')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="npwpd" class="small">NPWPD</label>
            <input id="npwpd" name="npwpd" type="text" class="form-control form-control-user"
                value="{{ old('npwpd', $user->npwpd) }}" autocomplete="off" />
            @error('npwpd')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="nohp" class="small">No. HP</label>
            <input id="nohp" name="nohp" type="tel" class="form-control form-control-user"
                value="{{ old('nohp', $user->nohp) }}" autocomplete="tel" />
            @error('nohp')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="fotopengguna" class="small">Foto Pengguna</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="fotopengguna"
                        aria-describedby="inputGroupFileAddon01" onchange="previewImage(event)">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            @error('fotopengguna')
            <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="mt-2">
                <small>Preview:</small>
                <img id="preview" src="{{ $user->fotopengguna ? asset('storage/' . $user->fotopengguna) : '' }}"
                    alt="User Photo" class="img-thumbnail" style="max-width: 200px;" />
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
                    };
                    reader.readAsDataURL(event.target.files[0]);
                    }
    </script>
    @endpush
</section>