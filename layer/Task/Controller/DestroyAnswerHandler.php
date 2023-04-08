<?php

namespace Layer\Task\Controller;

use Layer\Task\Contracts\UseCase\AnswerUseCaseInterface;

final class DestroyAnswerHandler
{
    private AnswerUseCaseInterface $service;

    public function __construct(AnswerUseCaseInterface $service)
    {
        $this->service = $service;
    }

    public function handle(int $answerId): bool
    {
        return $this->service->destroy($answerId);
    }
}
