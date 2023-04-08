<?php

namespace Layer\Task\Dto;

use Entense\Extractor\Annotation\{Cast, Optional};
use Entense\Extractor\DataTransfer;

final class FilterTaskDto extends DataTransfer
{
    #[Cast, Optional]
    public ?int $status = null;

    #[Cast, Optional]
    public ?bool $tagged = null;
}
