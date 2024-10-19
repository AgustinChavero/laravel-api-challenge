<?php

namespace Database\Factories;

use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostCategoryFactory extends Factory
{
    protected $model = PostCategory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'color' => $this->faker->hexColor(),
        ];
    }
}
