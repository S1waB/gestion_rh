<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Leave Request') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('leave_requests.update', $leaveRequest->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Single row with 3 fields -->
                        <div class="mb-4">
                            <!-- Start Date -->
                            <div class="col-md-4">
                                <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="start_date" class="form-control" 
                                       value="{{ $leaveRequest->start_date }}" required>
                                @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- End Date -->
                            <div class="col-md-4">
                                <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                <input type="date" name="end_date" class="form-control" 
                                       value="{{ $leaveRequest->end_date }}" required>
                                @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-4">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select" {{ auth()->user()->isAdmin() ? '' : 'disabled' }}>
                                    <option value="pending" {{ $leaveRequest->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $leaveRequest->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $leaveRequest->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Reason textarea alone -->
                        <div class="mb-4">
                            <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
                            <textarea name="reason" class="form-control" rows="4" required>{{ $leaveRequest->reason }}</textarea>
                            @error('reason') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Action buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('leave_requests.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-arrow-left me-2"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i> Update Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>