<?php

namespace Layer\Task\Dto;

use Entense\Extractor\Annotation\{Cast, Optional, Required};
use Entense\Extractor\DataTransfer;

final class StoreAnswerDto extends DataTransfer
{
    #[Cast, Required(reason: 'We need a "text"')]
    public string $text;

    #[Cast, Optional]
    public array $files;
}
