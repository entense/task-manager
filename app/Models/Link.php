<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class Link extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link'
    ];

    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }
}
