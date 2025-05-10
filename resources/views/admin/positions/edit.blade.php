<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <svg class="h-6 w-6 text-primary mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <h2 class="text-xl font-semibold text-gray-800">Edit Position</h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <form method="POST" action="{{ route('admin.positions.update', $position) }}">
                @csrf
                @method('PUT')

                <!-- Title Field -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2 flex items-center">
                        <svg class="h-5 w-5 text-primary mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Title <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="title"
                        class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary"
                        value="{{ old('title', $position->title) }}"
                        required
                        placeholder="Position title">
                </div>

                <!-- Description Field -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2 flex items-center">
                        <svg class="h-5 w-5 text-primary mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Description
                    </label>
                    <textarea name="description"
                        class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary"
                        rows="4"
                        placeholder="Position description">{{ old('description', $position->description) }}</textarea>
                </div>

                <!-- Base Salary Field -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2 flex items-center">
                        <svg class="h-5 w-5 text-primary mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Base Salary <span class="text-danger">*</span>
                    </label>

                    <div class="row mb-3 align-items-center">
                        <div class="col-8">
                            <div class="input-group">
                                <span class="input-group-text">DT</span>
                                <input type="number" name="base_salary" step="0.01"
                                    class="form-control"
                                    value="{{ old('base_salary', $position->base_salary) }}"
                                    required
                                    placeholder="0.00">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.positions.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 flex items-center">
                        <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-primary text-white rounded hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 flex items-center">
                        <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Position
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>