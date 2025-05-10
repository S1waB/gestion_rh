<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveBalanceController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public welcome page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Breeze's auth routes (login, register, etc.)
require __DIR__ . '/auth.php';

// Routes that require authentication & email verification
Route::middleware(['auth', 'verified'])->group(function () {

    // Common dashboard redirect
    Route::get('/dashboard', function () {
        $role = Auth::user()?->role?->name;

        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'chef_departement' => redirect()->route('chef.dashboard'),
            default => redirect()->route('employee.dashboard'),
        };
    })->name('dashboard');

    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

        // Admin user management routes
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{user}', [UserController::class, 'show'])->name('show');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        });
        // Admin Department management routes
        Route::prefix('departments')->name('departments.')->group(function () {
            Route::get('/', [DepartmentController::class, 'index'])->name('index');
            Route::get('/create', [DepartmentController::class, 'create'])->name('create');
            Route::post('/', [DepartmentController::class, 'store'])->name('store');
            Route::get('/{department}', [DepartmentController::class, 'show'])->name('show');
            Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->name('edit');
            Route::put('/{department}', [DepartmentController::class, 'update'])->name('update');
            Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('destroy');
        });
        // positions Department management routes
        Route::prefix('positions')->name('positions.')->group(function () {
            Route::get('/', [PositionController::class, 'index'])->name('index');
            Route::get('/create', [PositionController::class, 'create'])->name('create');
            Route::post('/', [PositionController::class, 'store'])->name('store');
            Route::get('/{position}', [PositionController::class, 'show'])->name('show');
            Route::get('/{position}/edit', [PositionController::class, 'edit'])->name('edit');
            Route::put('/{position}', [PositionController::class, 'update'])->name('update');
            Route::delete('/{position}', [PositionController::class, 'destroy'])->name('destroy');
        });

        // Leave Balance Management
        Route::prefix('leave-balances')->name('leave_balances.')->group(function () {
            Route::get('/', [LeaveBalanceController::class, 'index'])->name('index');
            Route::get('/{leave_balance}/edit', [LeaveBalanceController::class, 'edit'])->name('edit');
            Route::put('/{leave_balance}', [LeaveBalanceController::class, 'update'])->name('update');
            Route::get('/create', [LeaveBalanceController::class, 'create'])->name('create');
            Route::post('/', [LeaveBalanceController::class, 'store'])->name('store');
        });
    });
    // Leave Request Management
    Route::prefix('leave-requests')->name('leave_requests.')->group(function () {
        Route::get('/', [LeaveRequestController::class, 'index'])->name('index'); 
        Route::get('/create', [LeaveRequestController::class, 'create'])->name('create');
        Route::post('/', [LeaveRequestController::class, 'store'])->name('store');
        Route::get('/{leave_request}', [LeaveRequestController::class, 'show'])->name('show');
        Route::get('/{leave_request}/edit', [LeaveRequestController::class, 'edit'])->name('edit');
        Route::put('/{leave_request}', [LeaveRequestController::class, 'update'])->name('update');
        Route::delete('/{leave_request}', [LeaveRequestController::class, 'destroy'])->name('destroy');
          // Approval Routes
          Route::post('/{leave_request}/approve', [LeaveRequestController::class, 'approve'])->name('approve');
          Route::post('/{leave_request}/reject', [LeaveRequestController::class, 'reject'])->name('reject');
   
    });

    // Chef departement routes
    Route::prefix('chef')->name('chef.')->group(function () {
        Route::get('/dashboard', fn() => view('chef_departement.dashboard'))->name('dashboard');
        // Add chef-specific routes here...
    });

    // Employee routes
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/dashboard', fn() => view('employee.dashboard'))->name('dashboard');
        // Add employee-specific routes here...
    });

    // Profile management (from Laravel Breeze)
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

// Breeze's auth routes (login, register, etc.)
require __DIR__ . '/auth.php';
