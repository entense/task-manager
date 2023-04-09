<?php

namespace App\Http\Controllers\API\V1;

use App\Components\Documentator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Destroy\TaskDestroyRequest;
use App\Http\Requests\List\TaskListRequest;
use App\Http\Requests\Store\TaskStoreRequest;
use App\Http\Requests\Update\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Contracts\Support\Responsable;
use Layer\Task\Controller\{DestroyTaskHandler, PaginateTaskHandler, StoreTaskHandler, UpdateTaskHandler};
use Layer\Task\Dto\{PaginateTaskDto, StoreTaskDto, UpdateTaskDto};
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

final class TaskController extends Controller
{
    public function __construct(
        private readonly StoreTaskHandler $storeAction,
        private readonly PaginateTaskHandler $paginateAction,
        private readonly UpdateTaskHandler $updateAction,
        private readonly DestroyTaskHandler $destroyAction,
    ) {
        //
    }

    #[OA\Post(
        path: '/v1/tasks',
        summary: 'Создать задачу',
        description: 'Требуются права администратора',
        tags: ['Задачи'],
        security: [['bearer' => []]],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(ref: '#/components/schemas/TaskStoreRequest'),
        ),
        responses: [
            new Documentator\Responses\DataResourceResponse(
                description: 'Метод возвращает созданную задачу',
                ref: '#/components/schemas/TaskResource',
            ),
            new Documentator\Responses\UnuthorizedResponse,
            new Documentator\Responses\ForbiddenResponse,
        ]
    )]
    public function store(TaskStoreRequest $request): Responsable
    {
        return TaskResource::make(
            $this->storeAction->handle(StoreTaskDto::from($request))
        );
    }

    #[OA\Get(
        path: '/v1/tasks',
        parameters: [
            new OA\QueryParameter(ref: '#/components/parameters/PaginateRequest.page'),
            new OA\QueryParameter(ref: '#/components/parameters/PaginateRequest.per_page'),
            new OA\QueryParameter(ref: '#/components/parameters/TaskListRequest.filter.status'),
            new OA\QueryParameter(ref: '#/components/parameters/TaskListRequest.filter.tagged'),
        ],
        summary: 'Получить список задач',
        tags: ['Задачи'],
        security: [['bearer' => []]],
        responses: [
            new Documentator\Responses\PaginateResourceResponse(
                description: 'Метод возвращает список задач с пагинацией',
                ref: '#/components/schemas/TaskResource',
            ),
            new Documentator\Responses\UnuthorizedResponse,
            new Documentator\Responses\ForbiddenResponse,
        ]
    )]
    public function index(TaskListRequest $request): Responsable
    {
        return TaskResource::collection(
            $this->paginateAction->handle(PaginateTaskDto::from($request))
        );
    }

    #[OA\Patch(
        path: '/v1/tasks/{taskId}',
        parameters: [
            new OA\PathParameter(
                parameter: 'taskId',
                name: 'taskId',
                description: 'ID задачи',
                required: true,
                example: 2,
                schema: new OA\Schema(
                    type: 'integer'
                )
            ),
        ],
        summary: 'Редактировать задачу',
        description: 'Требуются права администратора',
        tags: ['Задачи'],
        security: [['bearer' => []]],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(ref: '#/components/schemas/TaskUpdateRequest'),
        ),
        responses: [
            new Documentator\Responses\DataResourceResponse(
                description: 'Метод возвращает обновленную задачу',
                ref: '#/components/schemas/TaskResource',
            ),
            new Documentator\Responses\NotFoundResponse(description: 'Задача не найдена'),
            new Documentator\Responses\UnuthorizedResponse,
            new Documentator\Responses\ForbiddenResponse,
        ]
    )]
    public function update(TaskUpdateRequest $request, int $taskId): Responsable
    {
        return TaskResource::make(
            $this->updateAction->handle($taskId, UpdateTaskDto::from($request))
        );
    }

    #[OA\Delete(
        path: '/v1/tasks/{taskId}',
        description: 'Требуются права администратора',
        parameters: [
            new OA\PathParameter(
                parameter: 'taskId',
                name: 'taskId',
                description: 'ID задачи',
                required: true,
                example: 2,
                schema: new OA\Schema(
                    type: 'integer'
                )
            ),
        ],
        summary: 'Удалить задачу',
        tags: ['Задачи'],
        security: [['bearer' => []]],
        responses: [
            new Documentator\Responses\NoContentResponse(description: 'Задача удалена'),
            new Documentator\Responses\NotFoundResponse(description: 'Задача не найдена'),
            new Documentator\Responses\ForbiddenResponse,
        ]
    )]
    public function destroy(TaskDestroyRequest $request, int $taskId): Response
    {
        $this->destroyAction->handle($taskId);

        return response()->noContent();
    }
}
