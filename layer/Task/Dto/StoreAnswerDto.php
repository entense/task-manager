<?php

namespace Layer\Task\Dto;

use Entense\Extractor\Annotation\{Cast, Optional, Required};
use Entense\Extractor\DataTransfer;

final class StoreAnswerDto extends DataTransfer
{
    #[Cast, Required(reason: 'We need a "text"')]
    public readonly string $text;

    #[Cast, Optional]
    public readonly array $files;
}
