<x-guest-layout>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container">


        <h4 class="mb-4 text-center text-primary">Register</h4>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Row 1 -->
                <div class="col-md-4">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" required>
                    @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" required>
                    @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Row 2 -->
                <div class="col-md-4">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" class="form-control">
                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Birthday</label>
                    <input type="date" name="birthday" value="{{ old('birthday') }}" class="form-control">
                    @error('birthday') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="">Select...</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Role</label>
                    <select name="role_id" class="form-select" required>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Department</label>
                    <select name="department_id" class="form-select" required>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="row ">
                <!-- Row 3 -->


                <div class="col-md-7">
                    <label class="form-label">Position</label>
                    <select name="position_id" class="form-select" required>
                        @foreach($positions as $position)
                        <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>{{ $position->title }}</option>
                        @endforeach
                    </select>
                    @error('position_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-5">
                    <label class="form-label">Hire Date</label>
                    <input type="date" name="hire_date" value="{{ old('hire_date') }}" class="form-control">
                    @error('hire_date') <small class="text-danger">{{ $message }}</small> @enderror
                </div>


            </div>

            <div class="row ">

                <div class="col-md-4">
                    <label class="form-label">Current Salary</label>
                    <input type="number" step="0.01" name="current_salary" value="{{ old('current_salary') }}" class="form-control" required>
                    @error('current_salary') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-8">
                    <label class="form-label">Profile Picture</label>
                    <input type="file" name="profile_picture" class="form-control">
                    @error('profile_picture') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="row ">
                    <div class="col-md-5">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                        @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('login') }}" class="text-decoration-none">Already registered?</a>
                <button type="submit" class="btn btn-primary px-4">Register</button>
            </div>
        </form>

    </div>
</x-guest-layout>