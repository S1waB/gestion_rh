<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $leaveRequests = LeaveRequest::with('user')->latest()->paginate(10);

        // Add authorization flags to each request
        $leaveRequests->getCollection()->transform(function ($request) use ($user) {
            $request->canApproveReject = $user->isAdmin() &&
                !$request->isOwnedBy($user) &&
                $request->isPending();
            $request->canEdit = $request->isOwnedBy($user) && $request->isPending();
            $request->canDelete = $user->isAdmin() ||
                ($request->isOwnedBy($user) && $request->isPending());
            return $request;
        });

        return view('admin.leave_requests.index', compact('leaveRequests'));
    }

    public function create()
    {
        // Only show empty form
        return view('admin.leave_requests.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value >= $request->end_date) {
                        $fail('The start date must be before the end date.');
                    }
                }
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value <= $request->start_date) {
                        $fail('The end date must be after the start date.');
                    }
                }
            ],
            'reason' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        LeaveRequest::create($validated);

        return redirect()->route('leave_requests.index')->with('success', 'Leave request submitted.');
    }


    public function edit($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);


        return view('admin.leave_requests.edit', compact('leaveRequest'));
    }

    public function update(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
    
        // Additional validation to ensure user can only edit their own pending requests
        if ($leaveRequest->user_id !== auth()->id() || $leaveRequest->status !== 'pending') {
            if (!auth()->user()->isAdmin()) {
                abort(403, 'You can only edit your own pending leave requests.');
            }
        }
    
        $validated = $request->validate([
            'start_date' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value >= $request->end_date) {
                        $fail('The start date must be before the end date.');
                    }
                }
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value <= $request->start_date) {
                        $fail('The end date must be after the start date.');
                    }
                }
            ],
            'reason' => 'nullable|string|max:255',
        ]);
    
        $leaveRequest->update($validated);
    
        return redirect()->route('leave_requests.index')->with('success', 'Leave request updated.');
    }
    
    public function destroy(LeaveRequest $leaveRequest)
    {
        // Check if user is admin OR the owner of the request
        if (!(auth()->user()->isAdmin() || auth()->id() === $leaveRequest->user_id)) {
            abort(403, 'Unauthorized action.');
        }

        // Additional check - only allow deleting pending requests
        if (!$leaveRequest->isPending()) {
            return back()->with('error', 'Only pending leave requests can be deleted.');
        }

        $leaveRequest->delete();

        return redirect()->route('leave_requests.index')
            ->with('success', 'Leave request deleted successfully');
    }
    public function approve(LeaveRequest $leaveRequest)
{
    $user = auth()->user();

    // Check if user is admin and not approving their own request
    if (!$user->isAdmin()) {
        abort(403, 'Only administrators can approve leave requests.');
    }
    
    if ($leaveRequest->user_id === $user->id) {
        abort(403, 'You cannot approve your own leave requests.');
    }

    // Check if request is pending
    if (!$leaveRequest->isPending()) {
        return back()->with('error', 'Only pending leave requests can be approved.');
    }

    // Calculate number of days requested
    $startDate = new \DateTime($leaveRequest->start_date);
    $endDate = new \DateTime($leaveRequest->end_date);
    $daysRequested = $startDate->diff($endDate)->days + 1; // +1 to include both start and end days

    // Get the user's leave balance
    $leaveBalance = $leaveRequest->user->leaveBalance;

    // Verify the user has sufficient leave balance
    if ($leaveBalance->days_available < $daysRequested) {
        return back()->with('error', 'User does not have sufficient leave days available.');
    }

    // Deduct the days from the leave balance
    $leaveBalance->decrement('days_available', $daysRequested);

    // Update the leave request status
    $leaveRequest->update([
        'status' => 'approved',
        'approved_by' => $user->id,
        'approved_at' => now(),
    ]);

    return back()->with('success', 'Leave request has been approved. ' . $daysRequested . ' days deducted from balance.');
}
    public function reject(LeaveRequest $leaveRequest)
    {
        $user = auth()->user();

        // Check if user is admin and not rejecting their own request
        if (!$user->isAdmin() || $leaveRequest->user_id === $user->id) {
            abort(403, 'Unauthorized action.');
        }

        // Check if request is pending
        if ($leaveRequest->status !== 'pending') {
            return back()->with('error', 'Only pending leave requests can be rejected.');
        }

        $leaveRequest->update(['status' => 'rejected']);

        return back()->with('success', 'Leave request has been rejected.');
    }
}
