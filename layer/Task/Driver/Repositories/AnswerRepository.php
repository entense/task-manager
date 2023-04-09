<?php

namespace Layer\Task\Driver\Repositories;

use App\Models\{Task as TaskEloquent, TaskAnswer as TaskAnswerEloquent};
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Layer\Task\Contracts\Repositories\AnswerRepositoryInterface;
use Layer\Task\Dto\StoreAnswerDto;
use Layer\Task\Exceptions\{AnswerNotFoundException, TaskNotFoundException};
use Throwable;

final class AnswerRepository implements AnswerRepositoryInterface
{
    public function store(int $taskId, StoreAnswerDto $payload): TaskAnswerEloquent
    {
        $task = TaskEloquent::find($taskId);

        if (is_null($task)) {
            throw new TaskNotFoundException($taskId);
        }

        DB::beginTransaction();

        try {
            $answer = $task->answers()->create($payload->toArray());
            $answer->files()->createMany(Arr::map($payload->files, function ($media) {
                return ['media' => $media];
            }));
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $answer->fresh();
    }

    public function destroy(int $answerId): bool
    {
        $answer = TaskAnswerEloquent::find($answerId);

        if (is_null($answer)) {
            throw new AnswerNotFoundException($answerId);
        }

        return $answer->delete();
    }
}
