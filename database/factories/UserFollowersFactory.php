<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserFollower;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFollowersFactory extends Factory
{
    protected $model = UserFollower::class;

    public function definition(): array
    {
        return [
            'follower_id' => User::factory(),
            'followed_id' => User::factory(),
        ];
    }
}
