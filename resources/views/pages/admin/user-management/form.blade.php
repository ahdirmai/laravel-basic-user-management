<x-app-layout>
    <x-slot name="title">
        {{ isset($user) ? 'Edit User' : 'Create User' }}
    </x-slot>

    <x-slot name="header">
        <h1 class="h3 font-weight-bold text-primary">{{ isset($user) ? 'Edit User' : 'Create User' }}</h1>
    </x-slot>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ isset($user) ? 'Edit User Details' : 'Create a New User' }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($user))
                            @method('PUT')
                            @endif

                            {{-- NIK Field --}}
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                    name="nik" value="{{ old('nik', $user->nik ?? '') }}" placeholder="Enter NIK"
                                    required>
                                @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Name Field --}}
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name', $user->name ?? '') }}"
                                    placeholder="Enter full name" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- NPWPD Field --}}
                            <div class="form-group">
                                <label for="npwpd">NPWPD</label>
                                <input type="text" class="form-control @error('npwpd') is-invalid @enderror" id="npwpd"
                                    name="npwpd" value="{{ old('npwpd', $user->npwpd ?? '') }}"
                                    placeholder="Enter NPWPD" required>
                                @error('npwpd')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email Field --}}
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email', $user->email ?? '') }}"
                                    placeholder="Enter email address" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password Field --}}
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password"
                                    placeholder="{{ isset($user) ? 'Leave blank to keep current password' : 'Enter password' }}"
                                    {{ isset($user) ? '' : 'required' }}>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Role Field --}}
                            <div class="form-group">
                                <label for="role">Roles</label>
                                <select class="form-control @error('role') is-invalid @enderror" id="role" name="role"
                                    required>
                                    <option value="" disabled selected>Select a role</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ isset($user) && $user->
                                        getRoleNames()->contains($role->name) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Photo Field --}}
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                                    name="photo" accept="image/*" onchange="previewImage()">
                                @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                {{-- Preview Image --}}
                                <div class="mt-3">
                                    <img id="photoPreview"
                                        src="{{ isset($user) && $user->fotopengguna ? asset('storage/' . $user->fotopengguna) : 'https://via.placeholder.com/150' }}"
                                        alt="Photo Preview" class="img-thumbnail" width="150">
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-save"></i> {{ isset($user) ? 'Update User' : 'Create User' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript for Preview --}}
    <script>
        function previewImage() {
            const input = document.getElementById('photo');
            const preview = document.getElementById('photoPreview');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>