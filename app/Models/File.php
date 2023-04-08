<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Mostafaznv\Larupload\Storage\Attachment;
use Mostafaznv\Larupload\Traits\Larupload;

final class File extends BaseModel
{
    use HasFactory, Larupload;

    protected $fillable = [
        'media'
    ];

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }

    public function attachments(): array
    {
        return [
            Attachment::make('media'),
        ];
    }
}
