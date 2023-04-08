<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{HasMany, MorphMany};

final class Task extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'status',
        'title',
        'description',
        'tagged',
        'need_answer'
    ];

    protected $casts = [
        'status' => TaskStatus::class,
        'tagged' => 'bool',
        'need_answer' => 'bool',
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(TaskAnswer::class);
    }

    public function links(): MorphMany
    {
        return $this->morphMany(Link::class, 'linkable');
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
