<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use App\Models\Position;
use App\Models\Role;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $departments = Department::with(['head', 'users'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->withCount('users') // for employee_count
            ->paginate(10); // Use paginate instead of get()

        return view('admin.departments.index', compact('departments', 'search'));
    }


    public function show(Request $request, $id)
    {
        $department = Department::with('head')->findOrFail($id);

        $query = User::with(['role', 'position', 'department'])
            ->where('department_id', $id);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role_id', $request->input('role'));
        }

        if ($request->filled('position')) {
            $query->where('position_id', $request->input('position'));
        }

        $users = $query->paginate(10);

        $roles = Role::all();
        $positions = Position::all();

        return view('admin.departments.show', compact('department', 'users', 'roles', 'positions'));
    }

    public function create()
    {
        $users = User::all(); // or filter by role if needed
        return view('admin.departments.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Department::create($validated);

        return redirect()->route('admin.departments.index')
            ->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        $users = $department->users()->get(); // or filter based on role if needed
        return view('admin.departments.edit', compact('department', 'users'));
    }
    public function update(Request $request, Department $department)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'head_id' => 'nullable|exists:users,id',
    ]);

    $department->update([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    $newHeadId = $request->head_id;

    $headRoleId = Role::where('name', 'chef_departement')->value('id');
    $employeeRoleId = Role::where('name', 'employe')->value('id');

    // Find current head
    $currentHead = $department->head;

    // If there's a current head and it's different from new head, demote the old one
    if ($currentHead && $currentHead->id != $newHeadId) {
        $currentHead->update(['role_id' => $employeeRoleId]);
    }

    // Promote new head (if selected)
    if ($newHeadId) {
        $newHead = User::where('id', $newHeadId)
            ->where('department_id', $department->id) // Ensure same department
            ->first();

        if ($newHead) {
            $newHead->update(['role_id' => $headRoleId]);
        }
    }

    return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully.');
}
public function destroy(Department $department)
{
    // Optional: demote current head before deleting department
    $headRoleId = Role::where('name', 'chef_departement')->value('id');
    $employeeRoleId = Role::where('name', 'employe')->value('id');

    $head = $department->users()->where('role_id', $headRoleId)->first();
    if ($head) {
        $head->update(['role_id' => $employeeRoleId]);
    }

    // Nullify department_id for users
    foreach ($department->users as $user) {
        $user->update(['department_id' => null]);
    }

    $department->delete();

    return redirect()->route('admin.departments.index')->with('success', 'Department deleted successfully.');
}

}
