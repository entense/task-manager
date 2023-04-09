<?php

namespace Layer\Task\Driver\Repositories;

use App\Models\Task as TaskEloquent;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Layer\Task\Contracts\Repositories\TaskRepositoryInterface;
use Layer\Task\Dto\{FilterTaskDto, IndexTaskDto, PaginateTaskDto, StoreTaskDto, UpdateTaskDto};
use Layer\Task\Exceptions\TaskNotFoundException;
use Throwable;

final class TaskRepository implements TaskRepositoryInterface
{
    private function queryFilter(FilterTaskDto $payload): Builder
    {
        return TaskEloquent::query()
            ->when(!is_null($payload->status))->where('status', $payload->status)
            ->when(!is_null($payload->tagged))->where('tagged', $payload->tagged);
    }

    public function store(StoreTaskDto $payload): TaskEloquent
    {
        DB::beginTransaction();

        try {
            $task = TaskEloquent::create($payload->toArray());

            $task->links()->createMany($payload->links);
            $task->files()->createMany(Arr::map($payload->files, function ($media) {
                return ['media' => $media];
            }));
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $task->fresh();
    }

    public function index(IndexTaskDto $payload): Collection
    {
        $query = $this->queryFilter($payload->filter);

        return $query->all();
    }

    public function paginate(PaginateTaskDto $payload): LengthAwarePaginator
    {
        $query = $this->queryFilter($payload->filter);

        return $query->paginate($payload->perPage)->withQueryString();
    }

    public function show(int $taskId): TaskEloquent
    {
        $task = TaskEloquent::find($taskId);

        if (is_null($task)) {
            throw new TaskNotFoundException($taskId);
        }

        return $task;
    }

    public function update(int $taskId, UpdateTaskDto $payload): TaskEloquent
    {
        $task = TaskEloquent::find($taskId);

        if (is_null($task)) {
            throw new TaskNotFoundException($taskId);
        }

        DB::beginTransaction();

        try {
            $task->update($payload->toArray());
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $task;
    }

    public function destroy(int $taskId): bool
    {
        $task = TaskEloquent::find($taskId);

        if (is_null($task)) {
            throw new TaskNotFoundException($taskId);
        }

        return $task->delete();
    }

    public function restore(int $taskId): bool
    {
        $task = TaskEloquent::onlyTrashed()->find($taskId);

        if (is_null($task)) {
            throw new TaskNotFoundException($taskId);
        }

        return $task->restore();
    }
}
