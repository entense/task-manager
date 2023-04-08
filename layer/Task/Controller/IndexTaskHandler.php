<?php

namespace Layer\Task\Controller;

use Illuminate\Database\Eloquent\Collection;
use Layer\Task\Contracts\UseCase\TaskUseCaseInterface;
use Layer\Task\Dto\IndexTaskDto;

final class IndexTaskHandler
{
    private TaskUseCaseInterface $service;

    public function __construct(TaskUseCaseInterface $service)
    {
        $this->service = $service;
    }

    public function handle(IndexTaskDto $payload): Collection
    {
        return $this->service->index($payload);
    }
}
