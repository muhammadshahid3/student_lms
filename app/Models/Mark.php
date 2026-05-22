<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'exam_type',
        'obtained_marks',
        'total_marks',
        'percentage',
        'grade',
        'exam_date',
        'remarks',
        'uploaded_by',
    ];

    protected $casts = [
        'exam_date' => 'date',
        'obtained_marks' => 'decimal:2',
        'total_marks' => 'decimal:2',
        'percentage' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->total_marks > 0) {
                $model->percentage = ($model->obtained_marks / $model->total_marks) * 100;
                $model->grade = $model->calculateGrade($model->percentage);
            }
        });

        static::updating(function ($model) {
            if ($model->total_marks > 0) {
                $model->percentage = ($model->obtained_marks / $model->total_marks) * 100;
                $model->grade = $model->calculateGrade($model->percentage);
            }
        });
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'uploaded_by');
    }

    protected function calculateGrade($percentage): string
    {
        if ($percentage >= 90) return 'A+';
        if ($percentage >= 85) return 'A';
        if ($percentage >= 80) return 'A-';
        if ($percentage >= 75) return 'B+';
        if ($percentage >= 70) return 'B';
        if ($percentage >= 65) return 'B-';
        if ($percentage >= 60) return 'C+';
        if ($percentage >= 55) return 'C';
        if ($percentage >= 50) return 'D';
        return 'F';
    }
}
