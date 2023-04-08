<?php

namespace Layer\Task\Contracts\Repositories;

use App\Models\TaskAnswer;
use Layer\Task\Dto\StoreAnswerDto;

interface AnswerRepositoryInterface
{
    public function store(int $taskId, StoreAnswerDto $payload): TaskAnswer;

    public function destroy(int $answerId): bool;
}
