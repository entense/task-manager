<?php

namespace Layer\Task\Dto;

use Entense\Extractor\Annotation\Optional;
use Entense\Extractor\DataTransfer;

final class IndexTaskDto extends DataTransfer
{
    #[Optional(value: new FilterTaskDto)]
    public readonly FilterTaskDto $filter;
}
