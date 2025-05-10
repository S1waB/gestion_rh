<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'title',
        'description',
        'base_salary'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
