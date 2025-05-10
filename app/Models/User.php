<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'gender',
        'profile_picture',
        'birthday',
        'password',
        'role_id',
        'department_id',
        'position_id',
        'current_salary',
        'hire_date'
    ];
    public function getProfilePictureUrlAttribute()
    {
        return $this->profile_picture 
        ? asset('storage/'.$this->profile_picture) 
        : asset('images/default-avatar.png');
    }

    public function getInitialsAttribute()
    {
        return strtoupper(substr($this->first_name, 0, 1) . substr($this->last_name, 0, 1));
    }
    protected $hidden = ['password', 'remember_token'];
    
    protected $casts = [
        'birthday' => 'date',
        'hire_date' => 'date',
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->role->name === 'admin';
    }

    public function isDepartmentHead()
    {
        return $this->role->name === 'chef_departement';
    }

    public function isEmployee()
    {
        return $this->role->name === 'employe';
    }

    public function getFullNameAttribute()
{
    return "{$this->first_name} {$this->last_name}";
}

public function isDepartmentHeadOf($department)
{
    return $this->isDepartmentHead() && $this->department_id == $department->id;
}

public function leaveBalance()
{
    return $this->hasOne(LeaveBalance::class);
}

public function leaveRequests()
{
    return $this->hasMany(LeaveRequest::class);
}
}

