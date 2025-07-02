<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $project = Project::inRandomOrder()->first();

        $statusId = $project->workflow->statuses()->inRandomOrder()->value('id') ?? 1;

        return [
            'key' => $project->key . '-' . $project->tasks()->count() + 1,
            'summary' => $this->faker->sentence,
            'project_id' => $project->id,
            'status_id' => $statusId,
            'point' => $this->faker->numberBetween(1, 4),
        ];
    }
}
