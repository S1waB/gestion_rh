<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Leave') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('leave_requests.store') }}" method="POST">
                        @csrf

                        <!-- Start Date -->
                        <div class="mb-4">
                            <label for="start_date" class="block text-gray-700">Start Date</label>
                            <input type="date" name="start_date" class="w-full p-2 border rounded" required>
                        </div>

                        <!-- End Date -->
                        <div class="mb-4">
                            <label for="end_date" class="block text-gray-700">End Date</label>
                            <input type="date" name="end_date" class="w-full p-2 border rounded" required>
                        </div>

                        <!-- Reason -->
                        <div class="mb-4">
                            <label for="reason" class="block text-gray-700">Reason</label>
                            <textarea name="reason" class="w-full p-2 border rounded" required></textarea>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
