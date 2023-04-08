<?php

namespace Layer\Task\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;

final class AnswerNotFoundException extends ModelNotFoundException
{
    protected $message;

    protected $statusCode;

    protected $taskId;

    public function __construct($taskId)
    {
        $this->message = 'Ответ не найден.';
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
