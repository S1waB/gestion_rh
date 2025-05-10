<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'description','head_id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function head()
    {
        return $this->hasOne(User::class)
            ->where('role_id', Role::where('name', 'chef_departement')
                ->first()->id);
    }
    public function getEmployeesCountAttribute()
    {
        return $this->users()->count();
    }
}
