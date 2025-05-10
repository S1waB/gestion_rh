<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Role;  // Assuming you have a Role model
use App\Models\Department;  // Assuming you have a Department model
use App\Models\Position;  // Assuming you have a Position model
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Fetch roles, departments, and positions from the database
        $roles = Role::all();
        $departments = Department::all();
        $positions = Position::all();

        // Pass the fetched data to the view
        return view('auth.register', compact('roles', 'departments', 'positions'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:15'],
            'address' => ['nullable', 'string', 'max:255'],
            'birthday' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:male,female,other'],  // Validating the gender field
            'role_id' => ['required', 'exists:roles,id'],
            'department_id' => ['required', 'exists:departments,id'],
            'position_id' => ['required', 'exists:positions,id'],
            'current_salary' => ['required', 'numeric', 'min:0'],
            'hire_date' => ['nullable', 'date'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validate image
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }
        // Creating the user with the gender field
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'birthday' => $request->birthday,
            'gender' => $request->gender,  // Storing the gender
            'role_id' => $request->role_id,
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,
            'current_salary' => $request->current_salary,
            'hire_date' => $request->hire_date,
            'password' => Hash::make($request->password),
            'profile_picture' => $profilePicturePath,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
