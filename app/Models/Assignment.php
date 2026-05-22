<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'created_by',
        'title',
        'description',
        'instructions',
        'file_path',
        'due_date',
        'marks',
        'is_active',
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function isOverdue(): bool
    {
        return $this->due_date < now()->toDateString();
    }
}
