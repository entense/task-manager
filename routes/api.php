<?php

use App\Http\Controllers\API\V1\{TaskAnswerController, TaskController};
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::apiResource('tasks', TaskController::class);
    Route::apiResource('tasks.answers', TaskAnswerController::class)->shallow();
});
