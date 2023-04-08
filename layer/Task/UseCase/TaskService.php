<?php

namespace Layer\Task\UseCase;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Layer\Task\Contracts\Repositories\TaskRepositoryInterface;
use Layer\Task\Contracts\UseCase\TaskUseCaseInterface;
use Layer\Task\Dto\{IndexTaskDto, PaginateTaskDto, StoreTaskDto, UpdateTaskDto};

final class TaskService implements TaskUseCaseInterface
{
    private TaskRepositoryInterface $repository;

    public function __construct(TaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(StoreTaskDto $payload): Task
    {
        return $this->repository->store($payload);
    }

    public function index(IndexTaskDto $payload): Collection
    {
        return $this->repository->index($payload);
    }

    public function paginate(PaginateTaskDto $payload): LengthAwarePaginator
    {
        return $this->repository->paginate($payload);
    }

    public function show(int $taskId): Task
    {
        return $this->repository->show($taskId);
    }

    public function update(int $taskId, UpdateTaskDto $payload): Task
    {
        return $this->repository->update($taskId, $payload);
    }

    public function destroy(int $taskId): bool
    {
        return $this->repository->destroy($taskId);
    }

    public function restore(int $taskId): bool
    {
        return $this->repository->restore($taskId);
    }
}
