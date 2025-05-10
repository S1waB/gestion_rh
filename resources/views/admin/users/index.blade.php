<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-primary leading-tight">
            {{ __('Employees Management') }}
        </h2>
    </x-slot>

    <div class="container-fluid mt-3 px-4">
        <!-- Search and Filter Section -->
        <div class="row mb-4 g-3 align-items-center">
            <!-- Search Form -->
            <div class="col-md-4">
                <form method="GET" action="{{ route('admin.users.index') }}" class="row g-2">
                    <div class="col-md-5">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Search Users..."
                               class="form-control">
                    </div>
                    <div class="col-md-5">
                        <select name="search_field" class="form-select">
                            <option value="first_name" {{ request('search_field') == 'first_name' ? 'selected' : '' }}>First Name</option>
                            <option value="last_name" {{ request('search_field') == 'last_name' ? 'selected' : '' }}>Last Name</option>
                            <option value="email" {{ request('search_field') == 'email' ? 'selected' : '' }}>Email</option>
                            <option value="phone" {{ request('search_field') == 'phone' ? 'selected' : '' }}>Phone</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search">Filter</i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Advanced Filters -->
            <div class="col-md-6">
                <form method="GET" action="{{ route('admin.users.index') }}" class="row g-2">
                    <div class="col-md-4">
                        <select name="role_id" class="form-select">
                            <option value="">All Roles</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="department_id" class="form-select">
                            <option value="">All Departments</option>
                            @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="position_id" class="form-select">
                            <option value="">All Positions</option>
                            @foreach($positions as $position)
                            <option value="{{ $position->id }}" {{ request('position_id') == $position->id ? 'selected' : '' }}>
                                {{ $position->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            <!-- Add Button -->
            <div class="col-md-2 text-end">
                <a href="{{ route('admin.users.create') }}" class="btn btn-success w-100">
                    <i class="fas fa-plus"></i> Add Employee
                </a>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Profile</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td class="text-center">
                                    @if($user->profile_picture)
                                    <img src="{{ asset('storage/'.$user->profile_picture) }}" 
                                         alt="Profile"
                                         class="rounded-circle" 
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                    <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center" 
                                         style="width: 40px; height: 40px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    @endif
                                </td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->role->name ?? 'N/A' }}</td>
                                <td>{{ $user->department->name ?? 'N/A' }}</td>
                                <td>{{ $user->position->title ?? 'N/A' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit">Edit</i>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Delete this user?')">
                                                <i class="fas fa-trash">Delete</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-3 d-flex justify-content-center">
            {{ $users->onEachSide(1)->links() }}
        </div>
    </div>
</x-app-layout>