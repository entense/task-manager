<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * @property \App\Models\File $resource
 */
#[OA\Schema(
    schema: 'FileResource',
    type: 'object',
    properties: [
        new OA\Property(property: 'link'),
        new OA\Property(property: 'meta', type: 'object', properties: [
            new OA\Property(property: 'name'),
            new OA\Property(property: 'type'),
            new OA\Property(property: 'mime_type'),
            new OA\Property(property: 'width', type: 'integer', nullable: true),
            new OA\Property(property: 'height', type: 'integer', nullable: true),
            new OA\Property(property: 'duration', type: 'integer', nullable: true),
            new OA\Property(property: 'dominant_color', nullable: true),
            new OA\Property(property: 'format'),
            new OA\Property(property: 'cover'),
        ]),
    ]
)]
final class FileResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'link' => $this->resource->media->url(),
            'meta' => $this->resource->media->meta()
        ];
    }
}
