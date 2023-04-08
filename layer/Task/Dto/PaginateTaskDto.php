<?php

namespace Layer\Task\Dto;

use Entense\Extractor\Annotation\Optional;
use Entense\Extractor\DataTransfer;
use Layer\Task\Concerns\Dto\Paginateable;

final class PaginateTaskDto extends DataTransfer
{
    use Paginateable;

    #[Optional(value: new FilterTaskDto)]
    public readonly FilterTaskDto $filter;
}
