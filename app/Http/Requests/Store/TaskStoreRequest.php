<?php

namespace App\Http\Requests\Store;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Gate;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TaskStoreRequest',
    properties: [
        new OA\Property(
            property: 'title',
            type: 'string',
            description: 'Заголовок',
        ),
        new OA\Property(
            property: 'description',
            type: 'string',
            description: 'Описание',
        ),
        new OA\Property(
            property: 'need_answer',
            type: 'boolean',
        ),
        new OA\Property(
            property: 'links',
            type: 'array',
            description: 'Ссылки',
            items: new OA\Items(
                properties: [
                    new OA\Property(
                        property: 'title',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'link',
                        type: 'string',
                    ),
                ]
            )
        ),
        new OA\Property(
            property: 'files',
            description: 'Файлы',
            type: 'array',
            items: new OA\Items(
                description: 'Файл',
                type: 'file',
            ),
        ),
    ],
)]
final class TaskStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return Gate::check('create-task');
    }

    public function rules(): array
    {
        return [
            'title' => 'string|required',
            'description' => 'string|required',
            'need_answer' => 'boolval',
            'links' => 'array',
            'links.*.title' => 'string|required',
            'links.*.link' => 'string|required',
            'files' => 'array',
            'files.*' => 'file',
        ];
    }
}
