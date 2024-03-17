<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'author_id',
        'assigned_id',
        'title',
        'description',
        'due_at',
        'priority',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => TaskStatus::class,
        ];
    }

    public function author():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assigned():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
