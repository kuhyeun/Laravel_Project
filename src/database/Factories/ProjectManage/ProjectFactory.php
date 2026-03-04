<?php

namespace Database\Factories\ProjectManage;

use App\ProjectManage\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory {

    protected $model = Project::class;

    public function definition(): array {
        return [
            // 'name' => fake()->name(),
        ];
    }
}
