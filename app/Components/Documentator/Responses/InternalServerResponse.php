<?php

declare(strict_types=1);

namespace App\Components\Documentator\Responses;

use Attribute;
use OpenApi\{Attributes as OA, Generator};
use Symfony\Component\HttpFoundation\Response;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class InternalServerResponse extends \OpenApi\Annotations\Response
{
    public function __construct(
        ?string $description = null,
        ?array $headers = null,
        ?array $links = null,
        // annotation
        ?array $x = null,
        ?array $attachables = null
    ) {
        parent::__construct([
            'ref' => Generator::UNDEFINED,
            'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'description' => $description ?? 'Внутренняя ошибка сервера.',
            'x' => $x ?? Generator::UNDEFINED,
            'value' => $this->combine($headers, new OA\JsonContent(
                allOf: [
                    new OA\Schema(ref: '#/components/schemas/ExceptionResponse')
                ]
            ), $links, $attachables),
        ]);
    }
}
