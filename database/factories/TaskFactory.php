<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 3),
                'title' => 'Task:' . rand(0, 10000),
                'description' => fake()->text(),
                'extra_data' => "{
                    'enviorment': 'task enviorment',
                    'other': 'other punkt',
                }",
                'task_status' => 0,
                'due_date' => Carbon::now()->add(5, 'day')->format('Y-m-d H:i:s'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];
    }
}
