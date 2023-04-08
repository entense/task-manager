<?php

namespace Layer\Task\Controller;

use Layer\Task\Contracts\UseCase\TaskUseCaseInterface;

final class RestoreTaskHandler
{
    private TaskUseCaseInterface $service;

    public function __construct(TaskUseCaseInterface $service)
    {
        $this->service = $service;
    }

    public function handle(int $taskId): bool
    {
        return $this->service->restore($taskId);
    }
}
