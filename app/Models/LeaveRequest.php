<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'status',
        'reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // In App\Models\LeaveRequest.php

    public function isOwnedBy(User $user): bool
    {
        return $this->user_id === $user->id;
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
