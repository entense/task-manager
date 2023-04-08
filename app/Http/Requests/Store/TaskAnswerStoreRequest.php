<?php

namespace App\Http\Requests\Store;

use App\Http\Requests\BaseRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TaskAnswerStoreRequest',
    properties: [
        new OA\Property(
            property: 'text',
            type: 'string',
            description: 'Текст ответа',
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
final class TaskAnswerStoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'text' => 'string|required',
            'files' => 'array',
            'files.*' => 'file',
        ];
    }
}
