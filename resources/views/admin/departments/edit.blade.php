<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800">
                Edit Department: {{ $department->name }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-md mx-auto py-6 px-4">
        <!-- Alerts -->
        @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg border border-green-100 flex items-center">
            <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any()))
        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded-lg border border-red-100">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Please fix these errors:</span>
            </div>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <form action="{{ route('admin.departments.update', $department->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name Field -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1 flex items-center">
                        <svg class="h-4 w-4 text-blue-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Name
                    </label>
                    <input type="text" name="name" value="{{ old('name', $department->name) }}"
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400"
                        required>
                </div>

                <!-- Description Field -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1 flex items-center">
                        <svg class="h-4 w-4 text-blue-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Description
                    </label>
                    <textarea name="description" rows="3"
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400">{{ old('description', $department->description) }}</textarea>
                </div>

                <!-- Department Head Field -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-1 flex items-center">
                        <svg class="h-4 w-4 text-blue-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Department Head
                    </label>
                    <select name="head_id"
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400">
                        <option value="">-- None --</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            {{ (old('head_id', $department->head_id) == $user->id) ? 'selected' : '' }}>
                            {{ $user->first_name }} {{ $user->last_name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between">
                    <a href="{{ route('admin.departments.index') }}"
                        class="px-4 py-2 text-gray-600 rounded-lg hover:bg-gray-100 flex items-center">
                        <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Cancel
                    </a>
                    <button type="submit"
                        class="btn btn-primary ">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>