<?php

namespace Layer\Task\Controller;

use App\Models\TaskAnswer;
use Layer\Task\Contracts\UseCase\AnswerUseCaseInterface;
use Layer\Task\Dto\StoreAnswerDto;

final class StoreAnswerHandler
{
    private AnswerUseCaseInterface $service;

    public function __construct(AnswerUseCaseInterface $service)
    {
        $this->service = $service;
    }

    public function handle(int $taskId, StoreAnswerDto $payload): TaskAnswer
    {
        return $this->service->store($taskId, $payload);
    }
}
