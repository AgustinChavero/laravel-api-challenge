<?php

namespace Database\Factories;

use App\Models\PostInteraction;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostInteractionFactory extends Factory
{
    protected $model = PostInteraction::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'post_id' => Post::factory(),
            'liked' => $this->faker->boolean(),
            'favorited' => $this->faker->boolean(),
            'saved' => $this->faker->boolean(),
            'shared' => $this->faker->boolean(),
        ];
    }
}
