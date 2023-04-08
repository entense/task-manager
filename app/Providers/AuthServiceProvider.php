<?php

namespace App\Providers;

use App\Policies\TaskPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

final class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\Task::class => TaskPolicy::class,
    ];

    public function boot(): void
    {
        Gate::define('create-task', [TaskPolicy::class, 'create']);
        Gate::define('delete-task', [TaskPolicy::class, 'delete']);
        Gate::define('update-task', [TaskPolicy::class, 'update']);
    }
}
