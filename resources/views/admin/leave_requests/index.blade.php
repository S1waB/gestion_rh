<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            {{ __('Leave Requests') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <!-- Search and Create Button Row -->
<div class="flex justify-between items-center mb-6">
    <!-- Search Form -->
    <form method="GET" action="{{ route('leave_requests.index') }}" class="w-full max-w-md mr-4">
        <div class="relative flex items-center">
            <input 
                type="text" 
                name="search" 
                placeholder="Search requests..." 
                value="{{ request('search') }}"
                class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <div class="absolute left-3 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </form>

    <!-- Create Button -->
    <a href="{{ route('leave_requests.create') }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg inline-flex items-center transition-colors duration-200">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
    </svg>
    New Leave Request
</a>
</div>

            <!-- Leave Requests Table -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">User</th>
                            <th class="px-4 py-2 text-left">Reason</th>
                            <th class="px-4 py-2 text-left">Start Date</th>
                            <th class="px-4 py-2 text-left">End Date</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leaveRequests as $request)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $request->user->full_name }}</td>
                            <td class="px-4 py-2">{{ ucfirst($request->reason) }}</td>
                            <td class="px-4 py-2">{{ $request->start_date }}</td>
                            <td class="px-4 py-2">{{ $request->end_date }}</td>
                            <td class="px-4 py-2">
                                @if($request->status === 'approved')
                                    <span class="flex items-center text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ ucfirst($request->status) }}
                                    </span>
                                @elseif($request->status === 'rejected')
                                    <span class="flex items-center text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        {{ ucfirst($request->status) }}
                                    </span>
                                @else
                                    <span class="flex items-center text-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ ucfirst($request->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-2">
                                    @if($request->canEdit)
                                    <a href="{{ route('leave_requests.edit', $request) }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    @endif

                                    @if($request->canDelete)
                                    <form action="{{ route('leave_requests.destroy', $request) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 flex items-center" onclick="return confirm('Are you sure?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                    @endif

                                    @if($request->canApproveReject)
                                    <form action="{{ route('leave_requests.approve', $request) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('leave_requests.reject', $request) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-orange-600 hover:text-orange-900 ml-2 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Reject
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                No leave requests found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($leaveRequests->hasPages())
            <div class="mt-4">
                {{ $leaveRequests->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>