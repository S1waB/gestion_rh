<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-primary leading-tight">
            {{ __('Positions Management') }}
        </h2>
    </x-slot>

    <div class="container-fluid mt-3 px-4">
        <!-- Search and Filter Section -->
        <div class="row mb-4 g-3 align-items-center">
            <!-- Search Form -->
            <div class="col-md-4">
                <form method="GET" class="row g-2">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Search positions..."
                                   class="form-control">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Add Button -->
            <div class="col-md-8 text-end">
                <a href="{{ route('admin.positions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Position
                </a>
            </div>
        </div>

        <!-- Positions Table -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Base Salary</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($positions as $position)
                            <tr>
                                <td class="text-center">{{ $position->id }}</td>
                                <td>{{ $position->title }}</td>
                                <td>{{ $position->description ?? 'No description' }}</td>
                                <td>DT {{ number_format($position->base_salary, 2) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.positions.edit', $position->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.positions.destroy', $position->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Delete this position?')">
                                                <i class="fas fa-trash"></i> Delete
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
            {{ $positions->onEachSide(1)->links() }}
        </div>
    </div>
</x-app-layout>