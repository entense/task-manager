<?php

namespace Layer\Task\Dto;

use Entense\Extractor\Annotation\{Cast, Optional};
use Entense\Extractor\DataTransfer;

final class UpdateTaskDto extends DataTransfer
{
    #[Cast, Optional]
    public readonly int $status;

    #[Cast, Optional]
    public readonly bool $tagged;
}
