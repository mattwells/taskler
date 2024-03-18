<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/***
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $author_id
 * @property User $author
 * @property int $assigned_id
 * @property User $assigned
 * @property Carbon $dueAt
 * @property int $priority
 * @property TaskStatus $status
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
 * @property Carbon $deletedAt
 */
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

    protected $with = [
        'author',
        'assigned',
    ];

    protected function casts(): array
    {
        return [
            'status' => TaskStatus::class,
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assigned(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
