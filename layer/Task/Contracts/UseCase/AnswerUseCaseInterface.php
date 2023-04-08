<?php

namespace Layer\Task\Contracts\UseCase;

use App\Models\TaskAnswer;
use Layer\Task\Contracts\Repositories\AnswerRepositoryInterface;
use Layer\Task\Dto\StoreAnswerDto;

interface AnswerUseCaseInterface
{
    public function __construct(AnswerRepositoryInterface $repository);

    public function store(int $taskId, StoreAnswerDto $payload): TaskAnswer;

    public function destroy(int $answerId): bool;
}
