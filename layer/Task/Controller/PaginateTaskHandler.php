<?php

namespace Layer\Task\Controller;

use Illuminate\Pagination\LengthAwarePaginator;
use Layer\Task\Contracts\UseCase\TaskUseCaseInterface;
use Layer\Task\Dto\PaginateTaskDto;

final class PaginateTaskHandler
{
    private TaskUseCaseInterface $service;

    public function __construct(TaskUseCaseInterface $service)
    {
        $this->service = $service;
    }

    public function handle(PaginateTaskDto $payload): LengthAwarePaginator
    {
        return $this->service->paginate($payload);
    }
}
