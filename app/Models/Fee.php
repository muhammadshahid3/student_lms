<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'amount',
        'fee_type',
        'due_date',
        'status',
        'paid_date',
        'paid_amount',
        'notes',
        'transaction_id',
        'payment_method',
        'updated_by',
    ];

    protected $casts = [
        'due_date' => 'date',
        'paid_date' => 'date',
        'amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public function isOverdue(): bool
    {
        return $this->due_date < now()->toDateString() && $this->status !== 'paid';
    }

    public function getRemainingAmount(): float
    {
        return $this->amount - $this->paid_amount;
    }
}
