<?php

namespace App\Http\Controllers\API\V1;

use App\Components\Documentator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Destroy\TaskAnswerDestroyRequest;
use App\Http\Requests\Store\TaskAnswerStoreRequest;
use App\Http\Resources\TaskAnswerResource;
use Illuminate\Contracts\Support\Responsable;
use Layer\Task\Controller\{DestroyAnswerHandler, StoreAnswerHandler};
use Layer\Task\Dto\StoreAnswerDto;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

final class TaskAnswerController extends Controller
{
    public function __construct(
        private StoreAnswerHandler $storeAction,
        private DestroyAnswerHandler $destroyAction,
    ) {
        //
    }

    #[OA\Post(
        path: '/v1/tasks/{taskId}/answers',
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
        summary: 'Добавить ответ к задаче',
        tags: ['Ответы'],
        security: [['bearer' => []]],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(ref: '#/components/schemas/TaskAnswerStoreRequest'),
        ),
        responses: [
            new Documentator\Responses\DataResourceResponse(
                description: 'Метод возвращает созданную ответ',
                ref: '#/components/schemas/TaskAnswerResource',
            ),
            new Documentator\Responses\UnuthorizedResponse,
            new Documentator\Responses\ForbiddenResponse,
        ]
    )]
    public function store(TaskAnswerStoreRequest $request, int $taskId): Responsable
    {
        return TaskAnswerResource::make(
            $this->storeAction->handle($taskId, StoreAnswerDto::from($request))
        );
    }

    #[OA\Delete(
        path: '/v1/answers/{answerId}',
        parameters: [
            new OA\PathParameter(
                parameter: 'answerId',
                name: 'answerId',
                description: 'ID ответа',
                required: true,
                example: 2,
                schema: new OA\Schema(
                    type: 'integer'
                )
            ),
        ],
        summary: 'Удалить ответ',
        tags: ['Ответы'],
        security: [['bearer' => []]],
        responses: [
            new Documentator\Responses\NoContentResponse(description: 'Ответ удален'),
            new Documentator\Responses\NotFoundResponse(description: 'Ответ не найден'),
            new Documentator\Responses\ForbiddenResponse,
        ]
    )]
    public function destroy(TaskAnswerDestroyRequest $request, int $answerId): Response
    {
        $this->destroyAction->handle($answerId);

        return response()->noContent();
    }
}
