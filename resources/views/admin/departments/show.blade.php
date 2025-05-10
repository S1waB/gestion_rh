<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Department Details') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8 px-4">
        <!-- Department Details Card -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6 border border-gray-200">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $department->name }}</h3>
            <p class="text-gray-600 mb-2"><strong>Description:</strong> {{ $department->description ?? 'N/A' }}</p>

            @if($department->head)
            <div class="flex items-center gap-4 mt-4">
                <!-- Head's Profile Picture -->
                @if($department->head->profile_picture)
                <img src="{{ asset('storage/'.$department->head->profile_picture) }}"
                    alt="Head"
                    style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc;">
                @else
                <div style="width: 60px; height: 60px; border-radius: 50%; background-color: #e5e7eb; border: 2px solid #ccc;"
                    class="flex items-center justify-center">
                    <span style="font-size: 10px; color: #6b7280;">No Image</span>
                </div>
                @endif
                <div>
                    <p class="text-gray-700"><strong>Department Head:</strong> {{ $department->head->first_name }} {{ $department->head->last_name }}</p>
                    <p class="text-sm text-gray-500">{{ $department->head->email }}</p>
                </div>
            </div>
            @else
            <p class="text-gray-600 mt-4"><strong>Department Head:</strong> Not assigned</p>
            @endif
        </div>
        <!-- Search & Filters using Bootstrap row/col -->
        <form method="GET" class="mb-4">
            <div class="row g-3 align-items-end">
                <!-- Search -->
                <div class="col-md-3">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-control rounded-lg" placeholder="Search by name or email">
                </div>

                <!-- Role Filter -->
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">All Roles</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Position Filter -->
                <div class="col-md-3">
                    <select name="position" class="form-select">
                        <option value="">All Positions</option>
                        @foreach ($positions as $position)
                        <option value="{{ $position->id }}" {{ request('position') == $position->id ? 'selected' : '' }}>
                            {{ $position->title }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>

        <!-- Employees Table -->
        <h3 class="text-xl font-semibold text-gray-800 mb-3">Employees in this Department</h3>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg border border-gray-200 w-full">

            <table class="w-full border-collapse">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Profile</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">First Name</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Last Name</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Phone</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Role</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Position</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b border-gray-100">
                            <div class="flex justify-center">
                                @if($user->profile_picture)
                                <img src="{{ asset('storage/'.$user->profile_picture) }}"
                                    alt="Profile"
                                    style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 1px solid #ccc;">
                                @else
                                <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #e5e7eb; border: 1px solid #ccc;"
                                    class="flex items-center justify-center">
                                    <span style="font-size: 10px; color: #6b7280;">No Image</span>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $user->first_name }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $user->last_name }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $user->phone }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $user->role->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">{{ $user->position->title ?? 'N/A' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex justify-center">
            {{ $users->onEachSide(1)->links() }}
        </div>
    </div>
</x-app-layout>