<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TaskAnswerResource',
    type: 'object',
    properties: [
        new OA\Property(property: 'id', type: 'integer'),
        new OA\Property(property: 'text', type: 'string'),
        new OA\Property(property: 'files', type: 'array', items: new OA\Items('#/components/schemas/FileResource')),
    ]
)]
class TaskAnswerResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'files' => FileResource::collection($this->files),
        ];
    }
}
