<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Departments Management') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8 px-4">
        <!-- Top Bar -->
        <div class="flex items-center justify-between mb-6 gap-3">
            <!-- Search -->
            <form method="GET" action="{{ route('admin.departments.index') }}" class="flex items-center gap-2 w-full md:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Departments..."
                    class="p-2 border border-gray-300 rounded-lg w-full md:w-64">
                <button type="submit"
                    class="btn btn-primary w-20">
                    Search
                </button>
            </form>

            <!-- Add Button -->
            <a href="{{ route('admin.departments.create') }}"
                class="btn btn-success w-50">
                Add New Department
            </a>
        </div>

        @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-300 rounded-lg">
            <strong>There were some errors:</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

       <!-- Department Cards Grid - Changed to 3 columns -->
       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($departments as $department)
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow flex flex-col h-full">
                <!-- Card Header with Icon -->
                <div class="bg-blue-50 p-4 flex items-center">
                    <div class="bg-blue-100 p-3 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $department->name }}</h3>
                </div>

                <!-- Card Body -->
                <div class="p-4 flex-grow">
                    <div class="flex items-start mb-3 text-sm text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="line-clamp-2">{{ $department->description ?: 'No description' }}</span>
                    </div>

                    <div class="flex items-center mb-3 text-sm text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="truncate">{{ $department->head ? $department->head->first_name . ' ' . $department->head->last_name : 'No head' }}</span>
                    </div>

                    <div class="flex items-center text-sm text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>{{ $department->users_count }} {{ Str::plural('employee', $department->users_count) }}</span>
                    </div>
                </div>

                <!-- Card Footer with Actions -->
                <div class="bg-gray-50 px-4 py-3 flex justify-between items-center border-t border-gray-200">
                    <a href="{{ route('admin.departments.show', $department->id) }}" 
                       class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        View
                    </a>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.departments.edit', $department->id) }}" 
                           class="text-yellow-600 hover:text-yellow-800" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        <form action="{{ route('admin.departments.destroy', $department->id) }}" method="POST"
                            onsubmit="return confirm('Delete this department?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $departments->links() }}
        </div>
    </div>
</x-app-layout>