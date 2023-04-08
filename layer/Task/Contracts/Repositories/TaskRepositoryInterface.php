<?php

namespace Layer\Task\Contracts\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Layer\Task\Dto\{IndexTaskDto, PaginateTaskDto, StoreTaskDto, UpdateTaskDto};

interface TaskRepositoryInterface
{
    public function store(StoreTaskDto $payload): Task;

    public function index(IndexTaskDto $payload): Collection;

    public function paginate(PaginateTaskDto $payload): LengthAwarePaginator;

    public function show(int $taskId): Task;

    public function update(int $taskId, UpdateTaskDto $payload): Task;

    public function destroy(int $taskId): bool;

    public function restore(int $taskId): bool;
}
