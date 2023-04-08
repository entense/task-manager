<?php

namespace Layer\Task\Concerns\Dto;

use Entense\Extractor\Annotation\{Alias, Cast, Optional};

trait Paginateable
{
    #[Cast, Optional(value: 1)]
    public readonly int $page;

    #[Cast, Optional(value: 15), Alias('per_page')]
    public readonly int $perPage;
}
