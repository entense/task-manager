<?php

namespace Layer\Task\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;

final class TaskNotFoundException extends ModelNotFoundException
{
    protected $message;

    protected $statusCode;

    protected $taskId;

    public function __construct($taskId)
    {
        $this->message = 'Задача не найдена.';
        $this->statusCode = 404;
        $this->taskId = $taskId;
    }

    public function report()
    {
        //
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getTaskId()
    {
        return $this->taskId;
    }
}
