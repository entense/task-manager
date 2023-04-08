<?php

namespace Layer\Task\Controller;

use App\Models\Task;
use Layer\Task\Contracts\UseCase\TaskUseCaseInterface;
use Layer\Task\Dto\UpdateTaskDto;

final class UpdateTaskHandler
{
    private TaskUseCaseInterface $service;

    public function __construct(TaskUseCaseInterface $service)
    {
        $this->service = $service;
    }

    public function handle(int $taskId, UpdateTaskDto $payload): Task
    {
        return $this->service->update($taskId, $payload);
    }
}
