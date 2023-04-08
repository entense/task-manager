<?php

namespace Layer\Task\UseCase;

use App\Models\TaskAnswer;
use Layer\Task\Contracts\Repositories\AnswerRepositoryInterface;
use Layer\Task\Contracts\UseCase\AnswerUseCaseInterface;
use Layer\Task\Dto\StoreAnswerDto;

final class AnswerService implements AnswerUseCaseInterface
{
    private AnswerRepositoryInterface $repository;

    public function __construct(AnswerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(int $taskId, StoreAnswerDto $payload): TaskAnswer
    {
        return $this->repository->store($taskId, $payload);
    }

    public function destroy(int $answerId): bool
    {
        return $this->repository->destroy($answerId);
    }
}
