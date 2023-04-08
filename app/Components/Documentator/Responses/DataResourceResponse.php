<?php

declare(strict_types=1);

namespace App\Components\Documentator\Responses;

use Attribute;
use OpenApi\{Attributes as OA, Generator};
use Symfony\Component\HttpFoundation\Response;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class DataResourceResponse extends \OpenApi\Annotations\Response
{
    public function __construct(
        ?string $description = null,
        string|object|null $ref = null,
        ?bool $collection = null,
        array $additional = [],
        int|string $response = null,
        ?array $headers = null,
        $content = null,
        ?array $links = null,
        // annotation
        ?array $x = null,
        ?array $attachables = null
    ) {
        if ($collection && $ref) {
            $shema = new OA\Property(
                property: 'data',
                type: 'array',
                items: new OA\Items(
                    ref: $ref
                )
            );
        } elseif ($ref) {
            $shema = new OA\Property(
                property: 'data',
                ref: $ref,
            );
        }

        parent::__construct([
            'ref' => Generator::UNDEFINED,
            'response' => $response ?: Response::HTTP_OK,
            'description' => $description ?? Generator::UNDEFINED,
            'x' => $x ?? Generator::UNDEFINED,
            'value' => $this->combine($headers, new OA\JsonContent(
                allOf: [
                    new Oa\Schema(
                        properties: [
                            $shema,
                        ],
                    ),
                    ...$additional,
                ]
            ), $links, $attachables),
        ]);
    }
}
