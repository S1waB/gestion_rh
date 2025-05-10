<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0 text-center">Add New User</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" id="userForm">
                            @csrf

                            <!-- Personal Information Section -->
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">Personal Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="first_name" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="last_name" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="tel" name="phone" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="birthday" class="form-label">Birthday</label>
                                        <input type="date" name="birthday" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <!-- Employment Information Section -->
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">Employment Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
                                        <select name="role_id" class="form-select" required>
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="department_id" class="form-label">Department <span class="text-danger">*</span></label>
                                        <select name="department_id" class="form-select" required>
                                            @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="position_id" class="form-label">Position <span class="text-danger">*</span></label>
                                        <select name="position_id" class="form-select" required>
                                            @foreach ($positions as $position)
                                            <option value="{{ $position->id }}">{{ $position->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Combined Salary, Hire Date, and Gender row -->
                                    <div class="col-md-4">
                                        <label for="current_salary" class="form-label">Salary <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" name="current_salary" step="0.01" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="hire_date" class="form-label">Hire Date</label>
                                        <input type="date" name="hire_date" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select name="gender" class="form-select">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Account Information Section -->
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">Account Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Profile Picture Section -->
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">Profile Picture</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="profile_picture" class="form-label">Upload Photo</label>
                                        <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept=".jpg,.jpeg,.png">
                                        <div class="form-text">Accepted formats: JPG, JPEG, PNG (Max 2MB)</div>
                                        <div id="fileError" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center h-100">
                                            <div id="imagePreview" class="border rounded p-2 text-center" style="width: 100px; height: 100px; display: none;">
                                                <img id="previewImage" class="img-fluid h-100" style="object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary me-md-2">
                                    <i class="fas fa-arrow-left me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Create User
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
            const fileError = document.getElementById('fileError');
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
                    previewContainer.style.display = 'none';
                    return;
                }
                
                if (file.size > maxSize) {
                    fileError.textContent = 'File size must be less than 2MB.';
                    this.classList.add('is-invalid');
                    this.value = '';
                    previewContainer.style.display = 'none';
                    return;
                }
                
                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        });

        // Form validation
        document.getElementById('userForm').addEventListener('submit', function(e) {
            const password = document.querySelector('input[name="password"]');
            const confirmPassword = document.querySelector('input[name="password_confirmation"]');
            
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                alert('Passwords do not match!');
                confirmPassword.focus();
            }
        });
    </script>
</x-app-layout>