<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'roll_number',
        'phone',
        'address',
        'date_of_birth',
        'status',
        'is_approved',
        'avatar',
        'total_fees',
        'fees_paid',
        'remarks',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'date_of_birth' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_student')
            ->withPivot('enrollment_status', 'grade', 'is_passed')
            ->withTimestamps();
    }

    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class);
    }

    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function fees(): HasMany
    {
        return $this->hasMany(Fee::class);
    }

    public function getFeesStatusAttribute(): string
    {
        if ($this->total_fees == 0) {
            return 'No fees';
        }
        if ($this->fees_paid >= $this->total_fees) {
            return 'Paid';
        }
        if ($this->fees_paid > 0) {
            return 'Partial';
        }
        return 'Unpaid';
    }
}
