<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostStat;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostStatFactory extends Factory
{
    protected $model = PostStat::class;

    public function definition(): array
    {
        return [
            'post_id' => Post::factory(),
            'likes_count' => $this->faker->numberBetween(0, 1000),
            'favs_count' => $this->faker->numberBetween(0, 500),
            'saves_count' => $this->faker->numberBetween(0, 300),
            'shares_count' => $this->faker->numberBetween(0, 200),
        ];
    }
}
