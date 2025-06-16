<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Workflow;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $projectName = fake()->firstNameMale();

        return [
            'key'   => strtoupper(substr($projectName, 0, 3)),
            'name'   => $projectName . "'s Project",
        ];
    }

    public function scrum(): Factory
    {
        return $this->state(fn(array $attributes) => ['type' => 'scrum'])
            ->afterCreating(function (Project $project) {
                $project->workflows()->saveMany([
                    new Workflow(['name' => 'Backlog']),
                    new Workflow(['name' => 'Sprint']),
                    new Workflow(['name' => 'In Progress']),
                    new Workflow(['name' => 'Review']),
                    new Workflow(['name' => 'Done']),
                ]);
            });
    }

    public function basic(): Factory
    {
        return $this->state(fn(array $attributes) => ['type' => 'basic'])
            ->afterCreating(function (Project $project) {
                $project->workflows()->saveMany([
                    new Workflow(['name' => 'To do']),
                    new Workflow(['name' => 'In Progress']),
                    new Workflow(['name' => 'Done']),
                ]);
            });
    }
}
