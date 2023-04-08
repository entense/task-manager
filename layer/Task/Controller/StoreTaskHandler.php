<?php

namespace Layer\Task\Controller;

use App\Models\Task;
use Layer\Task\Contracts\UseCase\TaskUseCaseInterface;
use Layer\Task\Dto\StoreTaskDto;

final class StoreTaskHandler
{
    private TaskUseCaseInterface $service;

    public function __construct(TaskUseCaseInterface $service)
    {
        $this->service = $service;
    }

    public function handle(StoreTaskDto $payload): Task
    {
        return $this->service->store($payload);
    }
}
