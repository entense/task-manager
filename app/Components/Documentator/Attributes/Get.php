<?php

declare(strict_types=1);

namespace App\Components\Documentator\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Get extends \OpenApi\Annotations\Get
{
    use OperationTrait;
}
