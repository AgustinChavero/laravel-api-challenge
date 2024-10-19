<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'category_id' => PostCategory::factory(),
            'enabled' => $this->faker->boolean(),
            'photo' => $this->faker->imageUrl(),
            'content' => $this->faker->paragraph(),
            'publication_date' => $this->faker->date(),
        ];
    }
}
