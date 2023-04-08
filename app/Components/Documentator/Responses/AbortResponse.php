<?php

declare(strict_types=1);

namespace App\Components\Documentator\Responses;

use Attribute;
use OpenApi\{Attributes as OA, Generator};
use Symfony\Component\HttpFoundation\Response;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class AbortResponse extends \OpenApi\Annotations\Response
{
    public function __construct(
        ?string $description = null,
        ?string $message = null,
        ?int $code = Response::HTTP_BAD_REQUEST,
        string|object|null $ref = null,
        int|string $response = null,
        ?array $headers = null,
        $content = null,
        ?array $links = null,
        // annotation
        ?array $x = null,
        ?array $attachables = null
    ) {
        parent::__construct([
            'ref' => Generator::UNDEFINED,
            'response' => $code,
            'description' => $description ?? Generator::UNDEFINED,
            'x' => $x ?? Generator::UNDEFINED,
            'value' => $this->combine($headers, new OA\JsonContent(
                allOf: [
                    new OA\Schema(ref: '#/components/schemas/ExceptionResponse')
                ]
            ), $links, $attachables),
        ]);
    }
}
