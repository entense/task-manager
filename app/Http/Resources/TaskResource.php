<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TaskResource',
    type: 'object',
    properties: [
        new OA\Property(property: 'id', type: 'integer'),
        new OA\Property(property: 'status', type: 'bool'),
        new OA\Property(property: 'title', type: 'string'),
        new OA\Property(property: 'description', type: 'string'),
        new OA\Property(property: 'tagged', type: 'bool'),
        new OA\Property(property: 'need_answer', type: 'bool'),
        new OA\Property(property: 'links', type: 'array', items: new OA\Items('#/components/schemas/LinkResource')),
        new OA\Property(property: 'files', type: 'array', items: new OA\Items('#/components/schemas/FileResource')),
        new OA\Property(property: 'answers', type: 'array', items: new OA\Items('#/components/schemas/TaskAnswerResource')),
    ]
)]
class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'title' => $this->title,
            'description' => $this->description,
            'tagged' => $this->tagged,
            'need_answer' => $this->need_answer,
            'links' => LinkResource::collection($this->links),
            'files' => FileResource::collection($this->files),
            'answers' => TaskAnswerResource::collection($this->answers),
        ];
    }
}
