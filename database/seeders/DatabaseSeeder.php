<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data (using model queries)
        LeaveRequest::query()->delete();
        LeaveBalance::query()->delete();
        User::query()->delete();
        Position::query()->delete();
        Department::query()->delete();
        Role::query()->delete();

        // Seed Roles
        $adminRole = Role::create(['name' => 'admin']);
        $deptHeadRole = Role::create(['name' => 'chef_departement']);
        $employeeRole = Role::create(['name' => 'employe']);

        // Seed Departments
        $itDept = Department::create([
            'name' => 'IT',
            'description' => 'Information Technology Department'
        ]);
        
        $hrDept = Department::create([
            'name' => 'HR',
            'description' => 'Human Resources Department'
        ]);
        
        $financeDept = Department::create([
            'name' => 'Finance',
            'description' => 'Finance and Accounting Department'
        ]);
        
        $marketingDept = Department::create([
            'name' => 'Marketing',
            'description' => 'Marketing and Sales Department'
        ]);

        // Seed Positions
        $devPosition = Position::create([
            'title' => 'Software Developer',
            'base_salary' => 50000,
            'description' => 'Develops software applications'
        ]);
        
        $hrPosition = Position::create([
            'title' => 'HR Manager',
            'base_salary' => 45000,
            'description' => 'Manages human resources'
        ]);
        
        $financePosition = Position::create([
            'title' => 'Financial Analyst',
            'base_salary' => 48000,
            'description' => 'Analyzes financial data'
        ]);
        
        $marketingPosition = Position::create([
            'title' => 'Marketing Specialist',
            'base_salary' => 42000,
            'description' => 'Handles marketing campaigns'
        ]);

        // Create Admin User
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'department_id' => $itDept->id,
            'position_id' => $devPosition->id,
            'current_salary' => 60000,
            'hire_date' => now()->subYears(2),
            'gender' => 'male'
        ]);

        // Create Department Head
        $deptHead = User::create([
            'first_name' => 'Department',
            'last_name' => 'Head',
            'email' => 'head@example.com',
            'password' => Hash::make('password'),
            'role_id' => $deptHeadRole->id,
            'department_id' => $hrDept->id,
            'position_id' => $hrPosition->id,
            'current_salary' => 55000,
            'hire_date' => now()->subYear(),
            'gender' => 'female'
        ]);

    

        // Create Regular Employees
        $employee1 = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role_id' => $employeeRole->id,
            'department_id' => $itDept->id,
            'position_id' => $devPosition->id,
            'current_salary' => 50000,
            'hire_date' => now()->subMonths(6),
            'gender' => 'male'
        ]);

        $employee2 = User::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role_id' => $employeeRole->id,
            'department_id' => $financeDept->id,
            'position_id' => $financePosition->id,
            'current_salary' => 48000,
            'hire_date' => now()->subMonths(3),
            'gender' => 'female'
        ]);

        // Create leave balances for non-admin users
        LeaveBalance::create([
            'user_id' => $deptHead->id,
            'days_available' => 30
        ]);
        
        LeaveBalance::create([
            'user_id' => $employee1->id,
            'days_available' => 30
        ]);
        
        LeaveBalance::create([
            'user_id' => $employee2->id,
            'days_available' => 30
        ]);

        // Create sample leave requests
        $employees = [$deptHead, $employee1, $employee2];

        foreach ($employees as $employee) {
            // Past approved leave
            LeaveRequest::create([
                'user_id' => $employee->id,
                'start_date' => now()->subDays(10),
                'end_date' => now()->subDays(8),
                'reason' => 'Family vacation',
                'status' => 'approved',
            ]);

            // Current pending leave
            LeaveRequest::create([
                'user_id' => $employee->id,
                'start_date' => now()->addDays(5),
                'end_date' => now()->addDays(7),
                'reason' => 'Doctor appointment',
                'status' => 'pending'
            ]);
        }
    }
}