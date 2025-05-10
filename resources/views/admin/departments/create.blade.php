<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <svg class="h-6 w-6 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <h2 class="text-xl font-semibold text-gray-800">Create Department</h2>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <form action="{{ route('admin.departments.store') }}" method="POST">
                @csrf

                <!-- Name Field -->
                <div class="p-6 border-b border-gray-100">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Department Name
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 @error('name') border-red-500 @enderror"
                        placeholder="Enter department name">
                    @error('name')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Description Field -->
                <div class="p-6 border-b border-gray-100">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Description
                    </label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400"
                        placeholder="Enter department description">{{ old('description') }}</textarea>
                </div>

                <!-- Department Head Field -->
                <div class="p-6">
                    <label for="head_id" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Department Head
                    </label>
                    <select name="head_id" id="head_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400">
                        <option value="">-- No Department Head --</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('head_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Form Actions -->
                <div class="bg-gray-50 px-6 py-4 flex justify-end">
                    <a href="{{ route('admin.departments.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 mr-3">
                        <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-700 focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Create Department
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>