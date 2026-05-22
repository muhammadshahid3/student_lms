<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'bio',
        'avatar',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'created_by');
    }

    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class, 'uploaded_by');
    }

    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class, 'marked_by');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'created_by');
    }

    public function notices(): HasMany
    {
        return $this->hasMany(Notice::class, 'created_by');
    }

    public function fees(): HasMany
    {
        return $this->hasMany(Fee::class, 'updated_by');
    }
}
