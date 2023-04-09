<?php

namespace App\Http\Requests\Update;

use App\Enums\TaskStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Enum;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TaskUpdateRequest',
    properties: [
        new OA\Property(
            property: 'status',
            type: 'enum',
            enum: TaskStatus::class
        ),
        new OA\Property(
            property: 'tagged',
            type: 'boolean',
        )
    ],
)]
final class TaskUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return Gate::check('update-task');
    }
    
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'status' => new Enum(TaskStatus::class),
            'tagged' => 'boolval'
        ];
    }
}
