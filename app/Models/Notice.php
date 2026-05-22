<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'title',
        'content',
        'type',
        'attachment_path',
        'publish_date',
        'expire_date',
        'is_active',
        'views',
    ];

    protected $casts = [
        'publish_date' => 'date',
        'expire_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function isExpired(): bool
    {
        if (!$this->expire_date) {
            return false;
        }
        return $this->expire_date < now()->toDateString();
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}
