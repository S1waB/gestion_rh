<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- First Row - 3 Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Employees Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Total Employees</h3>
                            <p class="text-2xl font-semibold text-gray-900">{{ $totalEmployees ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Active Employees Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Active Employees</h3>
                            <p class="text-2xl font-semibold text-gray-900">{{ $activeEmployees ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- New Hires Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">New Hires This Month</h3>
                            <p class="text-2xl font-semibold text-gray-900">{{ $newHiresThisMonth ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Row - 3 Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Departments Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Total Departments</h3>
                            <p class="text-2xl font-semibold text-gray-900">{{ $totalDepartments ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Pending Leave Requests</h3>
                            <p class="text-2xl font-semibold text-gray-900">{{ $pendingLeaveRequests ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Approved Requests -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Approved Requests</h3>
                            <p class="text-2xl font-semibold text-gray-900">{{ $approvedLeaveRequests ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Third Row - 1 Card (Rejected Requests) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Rejected Requests -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Rejected Requests</h3>
                            <p class="text-2xl font-semibold text-gray-900">{{ $rejectedLeaveRequests ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Departments and Positions Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Departments by Employee Count -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Departments by Employee Count</h3>
                    <div class="space-y-4">
                        @forelse($departmentsWithMostEmployees ?? [] as $department)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">{{ $department->name }}</span>
                                <span class="text-sm font-medium text-gray-700">{{ $department->users_count }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" 
                                     style="width: {{ ($totalEmployees > 0 ? ($department->users_count / $totalEmployees) * 100 : 0) }}%"></div>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500">No department data available</p>
                        @endforelse
                    </div>
                </div>

                <!-- Positions by Employee Count -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Positions by Employee Count</h3>
                    <div class="space-y-4">
                        @forelse($positions ?? [] as $position)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">{{ $position->title }}</span>
                                <span class="text-sm font-medium text-gray-700">{{ $position->users_count }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-green-600 h-2.5 rounded-full" 
                                     style="width: {{ ($totalEmployees > 0 ? ($position->users_count / $totalEmployees) * 100 : 0) }}%"></div>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500">No position data available</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Leave Requests Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Leave Requests</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <!-- Table content remains the same -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>