<?php

namespace App\Http\Requests\List;

use App\Enums\TaskStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;
use OpenApi\Attributes as OA;

#[
    OA\QueryParameter(
        parameter: 'TaskListRequest.filter.status',
        name: 'filter[status]',
        description: 'Фильтр по статусу.',
        required: false,
        schema: new OA\Schema(
            enum: TaskStatus::class
        )
    ),
    OA\QueryParameter(
        parameter: 'TaskListRequest.filter.tagged',
        name: 'filter[tagged]',
        description: 'Фильтр по отмеченным.',
        required: false,
        schema: new OA\Schema(
            enum: [0, 1]
        )
    ),
]
final class TaskListRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'page' => 'integer',
            'per_page' => 'integer',
            'filter.status' => new Enum(TaskStatus::class),
            'filter.tagged' => 'boolval',
        ];
    }
}
