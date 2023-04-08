<?php

namespace App\Components\Documentator;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ApiResponse',
    description: '',
)]
class Documentation
{
    //
}

#[
    OA\QueryParameter(
        parameter: 'PaginateRequest.page',
        name: 'page',
        description: 'Страница пагинации',
        required: false,
        schema: new OA\Schema(
            type: 'integer',
        ),
        example: 1,
    ),
    OA\QueryParameter(
        parameter: 'PaginateRequest.per_page',
        name: 'per_page',
        description: 'Количество элементов на странице',
        required: false,
        schema: new OA\Schema(
            type: 'integer',
        ),
        example: 15,
    )
]
class PaginateRequest
{
    //
}

#[OA\Schema(
    schema: 'PaginateResponse',
    description: '',
    properties: [
        new OA\Property(
            property: 'links',
            type: 'object',
            properties: [
                new OA\Property(
                    property: 'first',
                    type: 'string',
                    description: 'Первая страница пагинации',
                ),
                new OA\Property(
                    property: 'last',
                    type: 'string',
                    description: 'Последняя страница пагинации',
                ),
                new OA\Property(
                    property: 'prev',
                    type: 'string',
                    description: 'Предыдущая страница пагинации',
                    nullable: true,
                ),
                new OA\Property(
                    property: 'next',
                    type: 'string',
                    description: 'Следующая страница пагинации',
                    nullable: true,
                ),
            ]
        ),
        new OA\Property(
            property: 'meta',
            type: 'object',
            properties: [
                new OA\Property(
                    property: 'current_page',
                    type: 'integer',
                    description: 'Текущая страница',
                ),
                new OA\Property(
                    property: 'from',
                    type: 'integer',
                ),
                new OA\Property(
                    property: 'last_page',
                    type: 'integer',
                    description: 'Последняя страница пагинации',
                ),
                new OA\Property(
                    property: 'links',
                    type: 'array',
                    items: new OA\Items(
                        type: 'object',
                        description: 'Страница пагинации',
                        properties: [
                            new OA\Property(
                                property: 'url',
                                type: 'string',
                            ),
                            new OA\Property(
                                property: 'label',
                                type: 'string',
                            ),
                            new OA\Property(
                                property: 'active',
                                type: 'boolean',
                            ),
                        ]
                    )
                ),
                new OA\Property(
                    property: 'path',
                    type: 'string',
                ),
                new OA\Property(
                    property: 'per_page',
                    type: 'integer',
                ),
                new OA\Property(
                    property: 'to',
                    type: 'integer',
                ),
                new OA\Property(
                    property: 'total',
                    type: 'integer',
                ),
            ]
        )
    ]
)]
class PaginateResponse
{
    //
}

#[OA\Schema(
    schema: 'ExceptionResponse',
    allOf: [
        new OA\Schema('#/components/schemas/ApiResponse')
    ],
    description: '',
    properties: [
        new OA\Property(
            property: 'message',
            type: 'string',
        )
    ]
)]
#[OA\Schema(
    schema: 'NotFoundContent',
    description: 'Ресурс не найден.',
    allOf: [
        new OA\Schema('#/components/schemas/ExceptionResponse')
    ],
)]
#[OA\Schema(
    schema: 'FailedDependencyContent',
    description: 'Неудачная зависимость.',
    allOf: [
        new OA\Schema('#/components/schemas/ExceptionResponse')
    ],
)]
#[OA\Schema(
    schema: 'ToManyRequestContent',
    allOf: [
        new OA\Schema('#/components/schemas/ExceptionResponse')
    ],
)]
#[OA\Response(
    response: 'UnuthorizedResponse',
    description: 'Неавторизован',
    content: new OA\JsonContent(
        allOf: [
            new OA\Schema('#/components/schemas/ExceptionResponse')
        ],
    )
)]
#[OA\Response(
    response: 'ForbiddenResponse',
    description: 'Нет прав на это действие.',
    content: new OA\JsonContent(
        allOf: [
            new OA\Schema('#/components/schemas/ExceptionResponse')
        ],
    )
)]
#[OA\Response(
    response: 'UnprocessedResponse',
    description: 'Ошибка валидации',
    content: new OA\JsonContent(
        properties: [
            new OA\Property(
                property: 'success',
                type: 'boolean',
                example: false
            ),
            new OA\Property(
                property: 'message',
                type: 'string',
                example: 'Validation errors'
            ),
            new OA\Property(
                property: 'data',
                type: 'object',
                properties: [
                    new OA\Property(
                        property: 'key',
                        type: 'array',
                        description: 'Ключ параметра',
                        items: new OA\Items(
                            type: 'string',
                            description: 'Текст ошибки',
                        )
                    ),
                ]
            ),
        ],
    )
)]
class HandlerResponse
{
    //
}
