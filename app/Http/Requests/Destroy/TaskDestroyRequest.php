<?php

namespace App\Http\Requests\Destroy;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Gate;

final class TaskDestroyRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return Gate::check('delete-task');
    }
}
