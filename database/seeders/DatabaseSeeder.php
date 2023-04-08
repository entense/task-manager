<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{Task, TaskAnswer};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Task::factory(10)->create()->each(function ($task) {
            TaskAnswer::factory(rand(0, 5))->create(['task_id' => $task->id]);
        });
    }
}
