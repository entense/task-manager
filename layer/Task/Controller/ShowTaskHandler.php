<?php

namespace Layer\Task\Controller;

use App\Models\Task;
use Layer\Task\Contracts\UseCase\TaskUseCaseInterface;

final class ShowTaskHandler
{
    private TaskUseCaseInterface $service;

    public function __construct(TaskUseCaseInterface $service)
    {
        $this->service = $service;
    }

    public function handle(int $taskId): Task
    {
        return $this->service->show($taskId);
    }
}
