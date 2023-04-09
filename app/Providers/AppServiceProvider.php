<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Layer\Task;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * @var array<string, string>
     */
    public array $bindings = [
        Task\Contracts\Repositories\TaskRepositoryInterface::class => Task\Driver\Repositories\TaskRepository::class,
        Task\Contracts\UseCase\TaskUseCaseInterface::class => Task\UseCase\TaskService::class,
        Task\Contracts\Repositories\AnswerRepositoryInterface::class => Task\Driver\Repositories\AnswerRepository::class,
        Task\Contracts\UseCase\AnswerUseCaseInterface::class => Task\UseCase\AnswerService::class,
    ];

    public function boot(): void
    {
        Relation::morphMap([
            'task' => \App\Models\Task::class,
            'task_answer' => \App\Models\TaskAnswer::class,
            'user' => \App\Models\User::class,
        ]);
    }
}
