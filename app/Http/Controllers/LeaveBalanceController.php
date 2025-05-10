<?php
namespace App\Http\Controllers;

use App\Models\LeaveBalance;
use App\Models\User;
use Illuminate\Http\Request;

class LeaveBalanceController extends Controller
{
    public function index()
    {
        $leaveBalances = LeaveBalance::with('user')->paginate(10);
        return view('admin.leave_balances.index', compact('leaveBalances'));
    }

    public function edit(LeaveBalance $leaveBalance)
    {
        return view('admin.leave_balances.edit', compact('leaveBalance'));
    }

    public function update(Request $request, LeaveBalance $leaveBalance)
    {
        $validated = $request->validate([
            'days_available' => 'required|integer|min:0'
        ]);

        $leaveBalance->update($validated);

        return redirect()->route('leave_balances.index')
            ->with('success', 'Leave balance updated successfully');
    }
}