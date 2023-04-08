<?php

declare(strict_types=1);

namespace App\Components\Documentator\Responses;

use Attribute;
use OpenApi\{Attributes as OA, Generator};
use Symfony\Component\HttpFoundation\Response;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class FailedDependencyResponse extends \OpenApi\Annotations\Response
{
    public function __construct(
        ?string $description = null,
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
            'ref' => $ref ?? Generator::UNDEFINED,
            'response' => Response::HTTP_FAILED_DEPENDENCY,
            'description' => $description ?? Generator::UNDEFINED,
            'x' => $x ?? Generator::UNDEFINED,
            'value' => $this->combine($headers, new OA\JsonContent(
                allOf: [
                    new OA\Schema(ref: '#/components/schemas/FailedDependencyContent')
                ]
            ), $links, $attachables),
        ]);
    }
}
