<x-app-layout>
    <x-slot name="title">Edit User</x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0 text-center">Edit User</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Personal Information Section -->
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">Personal Information</h5>
                                <div class="row g-3">
                                    <!-- First Name -->
                                    <div class="col-md-4">
                                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                               value="{{ old('first_name', $user->first_name) }}" required>
                                        @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-md-4">
                                        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                               value="{{ old('last_name', $user->last_name) }}" required>
                                        @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-4">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-4">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone', $user->phone) }}">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Salary -->
                                    <div class="col-md-4">
                                        <label for="current_salary" class="form-label">Salary <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">DT</span>
                                            <input type="number" name="current_salary" step="0.01" 
                                                   class="form-control @error('current_salary') is-invalid @enderror"
                                                   value="{{ old('current_salary', $user->current_salary) }}" required>
                                        </div>
                                        @error('current_salary')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Employment Information Section -->
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">Employment Information</h5>
                                <div class="row g-3">
                                    <!-- Role -->
                                    <div class="col-md-4">
                                        <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
                                        <select name="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Department -->
                                    <div class="col-md-4">
                                        <label for="department_id" class="form-label">Department <span class="text-danger">*</span></label>
                                        <select name="department_id" class="form-select @error('department_id') is-invalid @enderror" required>
                                            @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Position -->
                                    <div class="col-md-4">
                                        <label for="position_id" class="form-label">Position <span class="text-danger">*</span></label>
                                        <select name="position_id" class="form-select @error('position_id') is-invalid @enderror" required>
                                            @foreach($positions as $position)
                                            <option value="{{ $position->id }}" {{ old('position_id', $user->position_id) == $position->id ? 'selected' : '' }}>
                                                {{ $position->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('position_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Profile Picture Section -->
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">Profile Picture</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="profile_picture" class="form-label">Upload Photo</label>
                                        <input type="file" name="profile_picture" id="profile_picture" 
                                               class="form-control @error('profile_picture') is-invalid @enderror" 
                                               accept=".jpg,.jpeg,.png">
                                        <div class="form-text">Accepted formats: JPG, JPEG, PNG (Max 2MB)</div>
                                        @error('profile_picture')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        @if($user->profile_picture)
                                        <div class="d-flex align-items-center h-100">
                                            <div class="border rounded p-2 text-center" style="width: 100px; height: 100px;">
                                                <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                                                     class="img-fluid h-100" style="object-fit: contain;">
                                            </div>
                                            <p class="text-muted ms-3 mb-0">Current profile picture</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary me-md-2">
                                    <i class="fas fa-arrow-left me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // File validation and preview
        document.getElementById('profile_picture').addEventListener('change', function() {
            const fileError = document.querySelector('.invalid-feedback');
            const previewContainer = document.getElementById('imagePreview');
            const previewImage = document.getElementById('previewImage');
            
            fileError.textContent = '';
            this.classList.remove('is-invalid');
            
            if (this.files.length > 0) {
                const file = this.files[0];
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                const maxSize = 2 * 1024 * 1024; // 2MB
                
                if (!allowedTypes.includes(file.type)) {
                    fileError.textContent = 'Only JPG, JPEG, and PNG files are allowed.';
                    this.classList.add('is-invalid');
                    this.value = '';
                    return;
                }
                
                if (file.size > maxSize) {
                    fileError.textContent = 'File size must be less than 2MB.';
                    this.classList.add('is-invalid');
                    this.value = '';
                    return;
                }
            }
        });
    </script>
</x-app-layout>