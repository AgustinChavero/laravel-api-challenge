<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Admin', 'Viewer']),
            'color' => $this->faker->hexColor(),
            'price' => $this->faker->numberBetween(0, 100),
        ];
    }
}
