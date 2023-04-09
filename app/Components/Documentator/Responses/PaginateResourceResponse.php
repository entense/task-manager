<?php

declare(strict_types=1);

namespace App\Components\Documentator\Responses;

use const ALLOF;

use Attribute;
use OpenApi\{Attributes as OA, Generator};
use Symfony\Component\HttpFoundation\Response;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class PaginateResourceResponse extends \OpenApi\Annotations\Response
{
    public function __construct(
        ?string $description = null,
        string|object|null $ref = null,
        array $allOf = [],
        array $additional = [],
        int|string $response = null,
        ?array $headers = null,
        $content = null,
        ?array $links = null,
        // annotation
        ?array $x = null,
        ?array $attachables = null
    ) {
        if ($allOf !== []) {
            $items = new OA\Items(
                $allOf !== [] ? ALLOF : [
                    new Oa\Schema($ref),
                    ...$allOf
                ]
            );
        } else {
            $items = new OA\Items($ref);
        }

        $content = new OA\JsonContent(
            allOf: [
                new Oa\Schema(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: $items
                        )
                    ],
                ),
                new OA\Schema(
                    ref: '#/components/schemas/PaginateResponse',
                ),
                ...$additional,
            ]
        );

        parent::__construct([
            'ref' => Generator::UNDEFINED,
            'response' => Response::HTTP_OK,
            'description' => $description ?? Generator::UNDEFINED,
            'x' => $x ?? Generator::UNDEFINED,
            'value' => $this->combine($headers, $content, $links, $attachables),
        ]);
    }
}
