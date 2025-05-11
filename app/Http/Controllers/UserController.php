<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function dashboard()
    {
         $stats = [
            'totalEmployees' => User::count(),
            'activeEmployees' => User::where('status', 'active')->count(),
            'newHiresThisMonth' => User::whereMonth('hire_date', now()->month)
                                     ->whereYear('hire_date', now()->year)
                                     ->count(),
            'totalDepartments' => Department::count(),
            'pendingLeaveRequests' => LeaveRequest::where('status', 'pending')->count(),
            'approvedLeaveRequests' => LeaveRequest::where('status', 'approved')->count(),
            'rejectedLeaveRequests' => LeaveRequest::where('status', 'rejected')->count(),
            'departmentsWithMostEmployees' => Department::withCount('users')
                                                ->orderByDesc('users_count')
                                                ->limit(5)
                                                ->get(),
            'positions' => Position::withCount('users')
                             ->orderByDesc('users_count')
                             ->limit(5)
                             ->get(),
            'recentLeaveRequests' => LeaveRequest::with('user.department')
                                          ->latest()
                                          ->limit(5)
                                          ->get()
        ];

        return view('dashboard', $stats);
    
    }


    public function index(Request $request)
    {
        $query = User::query()->with(['role', 'department', 'position']);

        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->filled('position_id')) {
            $query->where('position_id', $request->position_id);
        }

        if ($request->filled('search') && $request->filled('search_field')) {
            $searchField = $request->search_field;
            $searchValue = $request->search;

            // Only allow certain fields
            if (in_array($searchField, ['first_name', 'last_name', 'email', 'phone'])) {
                $query->where($searchField, 'LIKE', '%' . $searchValue . '%');
            }
        }

        $users = $query->paginate(10)->withQueryString();

        $roles = Role::all();
        $departments = Department::all();
        $positions = Position::all();

        return view('admin.users.index', compact('users', 'roles', 'departments', 'positions'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'role_id' => 'required|exists:roles,id',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'current_salary' => 'required|numeric',
            'hire_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $chefRoleId = \App\Models\Role::where('name', 'chef_departement')->value('id');

        if ($validated['role_id'] == $chefRoleId) {
            // Check if the department already has a chef
            $existingChef = \App\Models\User::where('department_id', $validated['department_id'])
                ->where('role_id', $chefRoleId)
                ->first();

            if ($existingChef) {
                return back()->withErrors(['role_id' => 'This department already has a department head.'])->withInput();
            }
        }

        // Default password
        $validated['password'] = bcrypt('password');

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }



    public function create()
    {
        $roles = Role::all();
        $departments = Department::all();
        $positions = Position::all();

        return view('admin.users.create', compact('roles', 'departments', 'positions'));
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'role_id' => 'required|exists:roles,id',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'current_salary' => 'required|numeric',
            'hire_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile picture update
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function edit($id)
    {
        $user = User::with(['role', 'department', 'position'])->findOrFail($id);
        $roles = Role::all();
        $departments = Department::all();
        $positions = Position::all();

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
            'departments' => $departments,
            'positions' => $positions
        ]);
    }

    public function destroy(User $user)
    {
        // Delete profile picture if exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
