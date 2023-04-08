<?php

namespace Layer\Task\Dto;

use Entense\Extractor\Annotation\{Cast, Optional, Required};
use Entense\Extractor\DataTransfer;

final class StoreTaskDto extends DataTransfer
{
    #[Cast, Required(reason: 'We need a "title"')]
    public readonly string $title;

    #[Cast, Required(reason: 'We need a "description"')]
    public readonly string $description;

    #[Cast, Optional(value: true)]
    public readonly bool $need_answer;

    #[Cast, Optional]
    public readonly array $links;

    #[Cast, Optional]
    public readonly array $files;
}
