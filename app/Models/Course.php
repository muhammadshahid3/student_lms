<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'created_by',
        'name',
        'slug',
        'description',
        'code',
        'duration_hours',
        'credits',
        'fee',
        'course_image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'fee' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'course_student')
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

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }
}
