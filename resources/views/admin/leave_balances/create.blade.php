<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Leave Balance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('leave-balances.store') }}">
                        @csrf

                        <!-- Select User -->
                        <div class="mb-4">
                            <label class="block text-gray-700">User</label>
                            <select name="user_id" class="w-full p-2 border rounded" required>
                                <option value="">-- Select User --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Days Available -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Days Available</label>
                            <input type="number" name="days_available" value="30" min="0" class="w-full p-2 border rounded" required>
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create Leave Balance</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
